<?php

namespace App\Repositories;

use App\Models\House;
use App\Repositories\Interfaces\HouseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class HouseRepository implements HouseRepositoryInterface
{
    protected House $houseModel;

    public function __construct(House $houseModel)
    {
        $this->houseModel = $houseModel;
    }

    public function getAll(): Collection
    {
        return $this->houseModel->all();
    }

    public function create(array $data): House
    {
        return $this->houseModel->create($data);
    }

    public function update(int $id, array $data): House
    {
        $model = $this->houseModel->findOrFail($id);

        $model->update($data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->houseModel->findOrFail($id);

        $model->delete();

        return true;
    }

    public function findById(int $id): House
    {
        return $this->houseModel->findOrFail($id);
    }
}
