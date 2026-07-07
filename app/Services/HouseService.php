<?php

namespace App\Services;

use App\Models\House;
use App\Repositories\Interfaces\HouseRepositoryInterface;
use App\Services\Interfaces\HouseServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class HouseService implements HouseServiceInterface
{
    protected HouseRepositoryInterface $houseRepository;

    public function __construct(HouseRepositoryInterface $houseRepository)
    {
        $this->houseRepository = $houseRepository;
    }

    public function getAll(): Collection
    {
        return $this->houseRepository->getAll();
    }

    public function create(array $data): House
    {
        return $this->houseRepository->create($data);
    }

    public function update(int $id, array $data): House
    {
        return $this->houseRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->houseRepository->delete($id);
    }

    public function findById(int $id): House
    {
        return $this->houseRepository->findById($id);
    }
}
