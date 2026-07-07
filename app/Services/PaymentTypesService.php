<?php

namespace App\Services;

use App\Models\PaymentTypes;
use App\Repositories\Interfaces\PaymentTypesRepositoryInterface;
use App\Services\Interfaces\PaymentTypesServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class PaymentTypesService implements PaymentTypesServiceInterface
{
    protected PaymentTypesRepositoryInterface $paymentTypesRepository;

    public function __construct(PaymentTypesRepositoryInterface $paymentTypesRepository)
    {
        $this->paymentTypesRepository = $paymentTypesRepository;
    }

    public function getAll(): Collection
    {
        return $this->paymentTypesRepository->getAll();
    }

    public function create(array $data): PaymentTypes
    {
        return $this->paymentTypesRepository->create($data);
    }

    public function update(int $id, array $data): PaymentTypes
    {
        return $this->paymentTypesRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->paymentTypesRepository->delete($id);
    }

    public function findById(int $id): PaymentTypes
    {
        return $this->paymentTypesRepository->findById($id);
    }
}
