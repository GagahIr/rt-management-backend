<?php

namespace App\Services\Interfaces; 

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;

interface InvoiceServiceInterface
{
    public function getAll(): Collection;
    public function create(array $data): Invoice;
    public function update(int $id, array $data): Invoice;
    public function delete(int $id): bool;
    public function findById(int $id): Invoice;
    
    public function getByMonthYear(int $month, int $year): Collection;
    public function getMonthlySummaryByYear(int $year): array;  
    public function payAdvance(array $data, int $durationMonths): Collection; 
    public function generateMonthlyBulk(int $month, int $year): array;
     public function getUnpaidInvoices(int $month, int $year): Collection;
}