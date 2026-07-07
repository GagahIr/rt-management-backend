<?php

namespace App\Services;

use App\Models\Expense;
use App\Repositories\Interfaces\ExpenseRepositoryInterface;
use App\Services\Interfaces\ExpenseServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ExpenseService implements ExpenseServiceInterface
{
    protected ExpenseRepositoryInterface $expenseRepository;

    public function __construct(ExpenseRepositoryInterface $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function getAll(): Collection
    {
        return $this->expenseRepository->getAll();
    }

    public function create(array $data): Expense
    {
        return $this->expenseRepository->create($data);
    }

    public function update(int $id, array $data): Expense
    {
        return $this->expenseRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->expenseRepository->delete($id);
    }

    public function findById(int $id): Expense
    {
        return $this->expenseRepository->findById($id);
    }

    public function getByMonthYear(int $month, int $year): Collection
    {
        return $this->expenseRepository->getByMonthYear($month, $year);
    }

    public function getMonthlySummaryByYear(int $year): array
    {
        return $this->expenseRepository->getMonthlySummaryByYear($year);
    }
}