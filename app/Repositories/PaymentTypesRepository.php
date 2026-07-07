<?php

namespace App\Repositories;

use App\Models\PaymentTypes;
use App\Repositories\Interfaces\PaymentTypesRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PaymentTypesRepository implements PaymentTypesRepositoryInterface
{
    protected PaymentTypes $paymentTypesModel;

    public function __construct(PaymentTypes $paymentTypesModel)
    {
        $this->paymentTypesModel = $paymentTypesModel;
    }

    public function getAll(): Collection
    {
        return $this->paymentTypesModel->all();
    }

    public function create(array $data): PaymentTypes
    {
        return $this->paymentTypesModel->create($data);
    }

    public function update(int $id, array $data): PaymentTypes
    {
        $model = $this->paymentTypesModel->findOrFail($id);

        $model->update($data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->paymentTypesModel->findOrFail($id);

        $model->delete();

        return true;
    }

    public function findById(int $id): PaymentTypes
    {
        return $this->paymentTypesModel->findOrFail($id);
    }
}
