<?php

namespace App\Repositories\Interfaces;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Collection;

interface ResidentRepositoryInterface
{
    public function getAll(): Collection;
    public function create(array $data): Resident;
    public function update(int $id, array $data): Resident;
    public function delete(int $id): bool;
    public function findById(int $id): Resident;
}
