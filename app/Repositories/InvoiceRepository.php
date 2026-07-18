<?php

namespace App\Repositories;

use App\Models\House;
use App\Models\Invoice;
use App\Models\PaymentTypes;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    protected Invoice $invoiceModel;
    protected PaymentTypes $PaymentTypes;
    protected House $House;

    public function __construct(Invoice $invoiceModel, PaymentTypes $PaymentTypes, House $House)
    {
        $this->invoiceModel = $invoiceModel;
        $this->PaymentTypes = $PaymentTypes;
        $this->House = $House;
    }

    public function getAll(): Collection
    {
        return $this->invoiceModel->with(['house', 'resident', 'paymentType'])
            ->orderBy('period_year', 'desc')
            ->orderBy('period_month', 'desc')
            ->get();
    }

    public function query(): Builder
    {
        return $this->invoiceModel->with('house', 'resident', 'paymentType');
    }

    public function create(array $data): Invoice
    {
        return $this->invoiceModel->create($data);
    }

    public function update(int $id, array $data): Invoice
    {
        $model = $this->invoiceModel->findOrFail($id);
        $model->update($data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->invoiceModel->findOrFail($id);
        $model->delete();

        return true;
    }

    public function findById(int $id): Invoice
    {
        return $this->invoiceModel->with(['house', 'resident', 'paymentType'])->findOrFail($id);
    }

    public function getByMonthYear(int $month, int $year): Collection
    {
        return $this->invoiceModel->with(['house', 'resident', 'paymentType'])
            ->where('period_month', $month)
            ->where('period_year', $year)
            ->get();
    }

    public function getMonthlySummaryByYear(int $year): array
    {
        return $this->invoiceModel->select(
            DB::raw('period_month as month'),
            DB::raw('SUM(amount) as total')
        )
            ->where('period_year', $year)
            ->where('status', 'Lunas')
            ->groupBy('period_month')
            ->pluck('total', 'month')
            ->toArray();
    }

    public function generateMonthlyBulk(int $month, int $year): array
    {
        $occupiedHouses = $this->House::whereHas('currentResident', function ($query) {
            $query->whereNull('end_date')->orWhereDate('end_date', '>', now()->toDateString());
        })->with('currentResident')->get();

        $paymentTypes = $this->PaymentTypes::all();

        $createdCount = 0;
        $skippedCount = 0;

        DB::transaction(function () use ($occupiedHouses, $paymentTypes, $month, $year, &$createdCount, &$skippedCount) {
            foreach ($occupiedHouses as $house) {
                $residentId = $house->currentResident->id_resident;

                foreach ($paymentTypes as $type) {
                    $invoice = $this->invoiceModel::firstOrCreate(
                        [
                            'house_id'        => $house->id,
                            'payment_type_id' => $type->id,
                            'period_month'    => $month,
                            'period_year'     => $year,
                        ],
                        [
                            'resident_id'  => $residentId,
                            'amount'       => $type->amount,
                            'status'       => 'Belum lunas',
                            'payment_date' => null
                        ]
                    );

                    if ($invoice->wasRecentlyCreated) {
                        $createdCount++;
                    } else {
                        $skippedCount++;
                    }
                }
            }
        });

        return ['created' => $createdCount, 'skipped' => $skippedCount];
    }

    public function getUnpaidInvoices(int $month, int $year): Collection
    {
        return $this->invoiceModel->with(['house', 'resident', 'paymentType'])
            ->where('period_month', $month)
            ->where('period_year', $year)
            ->where('status', 'Belum lunas')
            ->get();
    }
}
