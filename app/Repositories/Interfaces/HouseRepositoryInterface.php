<?php

namespace App\Repositories\Interfaces;

use App\Models\House;
use Illuminate\Database\Eloquent\Collection;

interface HouseRepositoryInterface
{
    public function getAll(): Collection;
    public function create(array $data): House;
    public function update(int $id, array $data): House;
    public function delete(int $id): bool;
    public function findById(int $id): House;
}
