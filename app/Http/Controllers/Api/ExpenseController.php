<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ExpenseRequest;
use App\Services\Interfaces\ExpenseServiceInterface;
use Illuminate\Http\JsonResponse;

final class ExpenseController extends ApiController
{
    protected ExpenseServiceInterface $expenseService;

    public function __construct(ExpenseServiceInterface $expenseService)
    {
        $this->expenseService = $expenseService;
    }

    public function getAll(): JsonResponse
    {
        try {
            $result = $this->expenseService->getAll();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function store(ExpenseRequest $request): JsonResponse
    {
        try {
            $result = $this->expenseService->create(
                $request->validated()
            );
            return $this->response('Data pengeluaran berhasil ditambahkan.', $result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function update(int $id, ExpenseRequest $request): JsonResponse
    {
        try {
            $this->expenseService->update($id, $request->validated());
            return $this->response('Data pengeluaran berhasil diubah.');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->expenseService->delete($id);
            return $this->response('Data pengeluaran berhasil dihapus.');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getByMonthYear(int $month, int $year): JsonResponse
    {
        try {
            $result = $this->expenseService->getByMonthYear($month, $year);
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getYearlySummary(int $year): JsonResponse
    {
        try {
            $result = $this->expenseService->getMonthlySummaryByYear($year);
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}