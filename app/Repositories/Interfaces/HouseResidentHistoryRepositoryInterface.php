<?php

namespace App\Repositories\Interfaces;

use App\Models\HouseResidentHistory;
use Illuminate\Database\Eloquent\Collection;

interface HouseResidentHistoryRepositoryInterface
{
    public function getAll(): Collection;
    public function create(array $data): HouseResidentHistory;
    public function update(int $id, array $data): HouseResidentHistory;
    public function delete(int $id): bool;
    public function findById(int $id): HouseResidentHistory;
    // public function getHouse(): array;
    // public function getResident(): array;
}
