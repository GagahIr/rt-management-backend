<?php

namespace App\Repositories\Interfaces;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Collection;

interface ExpenseRepositoryInterface
{
    public function getAll(): Collection;
    public function create(array $data): Expense;
    public function update(int $id, array $data): Expense;
    public function delete(int $id): bool;
    public function findById(int $id): Expense;
    
    public function getByMonthYear(int $month, int $year): Collection;
    public function getMonthlySummaryByYear(int $year): array;
}