<?php

namespace App\Services;

use App\Models\Invoice;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Services\Interfaces\InvoiceServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class InvoiceService implements InvoiceServiceInterface
{
    protected InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function getAll(): Collection
    {
        return $this->invoiceRepository->getAll();
    }

    public function create(array $data): Invoice
    {
        return $this->invoiceRepository->create($data);
    }

    public function update(int $id, array $data): Invoice
    {
        return $this->invoiceRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->invoiceRepository->delete($id);
    }

    public function findById(int $id): Invoice
    {
        return $this->invoiceRepository->findById($id);
    }

    public function getByMonthYear(int $month, int $year): Collection
    {
        return $this->invoiceRepository->getByMonthYear($month, $year);
    }

    public function getMonthlySummaryByYear(int $year): array
    {
        return $this->invoiceRepository->getMonthlySummaryByYear($year);
    }

    public function payAdvance(array $data, int $durationMonths): Collection
    {
        return DB::transaction(function () use ($data, $durationMonths) {
            $invoices = new Collection();

            $startMonth = (int) $data['period_month'];
            $startYear = (int) $data['period_year'];

            for ($i = 0; $i < $durationMonths; $i++) {
                $currentMonth = $startMonth + $i;
                $currentYear = $startYear;

                if ($currentMonth > 12) {
                    $addedYears = (int) floor(($currentMonth - 1) / 12);
                    $currentYear += $addedYears;
                    $currentMonth = (($currentMonth - 1) % 12) + 1;
                }

                $invoiceData = $data;
                $invoiceData['period_month'] = $currentMonth;
                $invoiceData['period_year'] = $currentYear;
                $invoiceData['status'] = 'Lunas';

                $invoiceData['payment_date'] = now()->toDateString();

                $invoice = $this->invoiceRepository->create($invoiceData);
                $invoices->push($invoice);
            }

            return $invoices;
        });
    }

    public function generateMonthlyBulk(int $month, int $year): array
    {
        return $this->invoiceRepository->generateMonthlyBulk($month, $year);
    }
    
     public function getUnpaidInvoices(int $month, int $year): Collection
     {
        return $this->invoiceRepository->getUnpaidInvoices($month, $year);
     }
}
