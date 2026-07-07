<?php

namespace App\Repositories;

use App\Models\Resident;
use App\Repositories\Interfaces\ResidentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ResidentRepository implements ResidentRepositoryInterface
{
    protected Resident $residentModel;

    public function __construct(Resident $residentModel)
    {
        $this->residentModel = $residentModel;
    }

    public function getAll(): Collection
    {
        return $this->residentModel->all();
    }

    public function create(array $data): Resident
    {
        return $this->residentModel->create($data);
    }

    public function update(int $id, array $data): Resident
    {
        $model = $this->residentModel->findOrFail($id);

        $model->update($data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->residentModel->findOrFail($id);

        $model->delete();

        return true;
    }

    public function findById(int $id): Resident
    {
        return $this->residentModel->findOrFail($id);
    }
}
