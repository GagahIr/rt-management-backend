<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\InvoiceRequest;
use App\Models\House;
use App\Services\Interfaces\InvoiceServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

final class InvoiceController extends ApiController
{
    protected InvoiceServiceInterface $invoiceService;

    public function __construct(InvoiceServiceInterface $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function getAll(): JsonResponse
    {
        try {
            $result = $this->invoiceService->getAll();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function dataTable(Request $request)
    {
            try {
                $result = $this->invoiceService->query();
                return DataTables::of($result)->make(true);
            } catch (\Throwable $th) {
                return $this->error($th);
            }
    

        return response()->json(['message' => 'Bad Request'], 400);
    }

    public function store(InvoiceRequest $request): JsonResponse
    {
        try {
            $result = $this->invoiceService->create(
                $request->validated()
            );
            return $this->response('Data tagihan berhasil ditambahkan.', $result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function storeAdvance(InvoiceRequest $request): JsonResponse
    {
        try {
            $duration = $request->input('duration_months', 1);

            $result = $this->invoiceService->payAdvance(
                $request->validated(),
                $duration
            );

            return $this->response("Berhasil membuat pembayaran lunas untuk $duration bulan.", $result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function update(int $id, InvoiceRequest $request): JsonResponse
    {
        try {
            $this->invoiceService->update($id, $request->validated());
            return $this->response('Data tagihan berhasil diubah.');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->invoiceService->delete($id);
            return $this->response('Data tagihan berhasil dihapus.');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getByMonthYear(int $month, int $year): JsonResponse
    {
        try {
            $result = $this->invoiceService->getByMonthYear($month, $year);
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getYearlySummary(int $year): JsonResponse
    {
        try {
            $result = $this->invoiceService->getMonthlySummaryByYear($year);
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getOccupiedHouses(): JsonResponse
    {
        try {
            $result = House::whereHas('currentResident', function ($query) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>', now()->toDateString());
            })
                ->with(['currentResident.resident'])
                ->get();

            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function generateBulk(Request $request): JsonResponse
    {
        try {
            $month = $request->input('month', now()->month);
            $year = $request->input('year', now()->year);

            $result = $this->invoiceService->generateMonthlyBulk($month, $year);

            return $this->response(
                "Proses selesai. {$result['created']} tagihan baru dibuat, {$result['skipped']} ditangguhkan karena sudah ada.",
                $result
            );
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function unpaidList(int $month, int $year): JsonResponse
    {
        try {
            $result = $this->invoiceService->getUnpaidInvoices($month, $year);
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
