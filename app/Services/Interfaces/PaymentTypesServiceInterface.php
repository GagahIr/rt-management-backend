<?php

namespace App\Services\Interfaces;

use App\Models\PaymentTypes;
use Illuminate\Database\Eloquent\Collection;

interface PaymentTypesServiceInterface
{
    public function getAll(): Collection;
    public function create(array $data): PaymentTypes;
    public function update(int $id, array $data): PaymentTypes;
    public function delete(int $id): bool;
    public function findById(int $id): PaymentTypes;
}
