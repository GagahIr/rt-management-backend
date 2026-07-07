<?php

namespace App\Services\Interfaces;

use App\Models\House;
use Illuminate\Database\Eloquent\Collection;

interface HouseServiceInterface
{
    public function getAll(): Collection;
    public function create(array $data): House;
    public function update(int $id, array $data): House;
    public function delete(int $id): bool;
    public function findById(int $id): House;
}
