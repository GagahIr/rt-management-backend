<?php

namespace App\Repositories;

use App\Models\Expense;
use App\Repositories\Interfaces\ExpenseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    protected Expense $expenseModel;

    public function __construct(Expense $expenseModel)
    {
        $this->expenseModel = $expenseModel;
    }

    public function getAll(): Collection
    {
        return $this->expenseModel->orderBy('expense_date', 'desc')->get();
    }

    public function create(array $data): Expense
    {
        return $this->expenseModel->create($data);
    }

    public function update(int $id, array $data): Expense
    {
        $model = $this->expenseModel->findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): bool
    {
        return $this->expenseModel->findOrFail($id)->delete();
    }

    public function findById(int $id): Expense
    {
        return $this->expenseModel->findOrFail($id);
    }

    public function getByMonthYear(int $month, int $year): Collection
    {
        return $this->expenseModel->whereMonth('expense_date', $month)->whereYear('expense_date', $year)->get();
    }

    public function getMonthlySummaryByYear(int $year): array
    {
        return $this->expenseModel->select(DB::raw('MONTH(expense_date) as month'), DB::raw('SUM(amount) as total'))
            ->whereYear('expense_date', $year)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
    }
}
