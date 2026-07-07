<?php

namespace App\Services;

use App\Models\HouseResidentHistory;
use App\Repositories\Interfaces\HouseResidentHistoryRepositoryInterface;
use App\Services\Interfaces\HouseResidentHistoryServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class HouseResidentHistoryService implements HouseResidentHistoryServiceInterface
{
    protected HouseResidentHistoryRepositoryInterface $houseResidentHistoryRepository;

    public function __construct(HouseResidentHistoryRepositoryInterface $houseResidentHistoryRepository)
    {
        $this->houseResidentHistoryRepository = $houseResidentHistoryRepository;
    }

    public function getAll(): Collection
    {
        return $this->houseResidentHistoryRepository->getAll();
    }

    public function create(array $data): HouseResidentHistory
    {
        return $this->houseResidentHistoryRepository->create($data);
    }

    public function update(int $id, array $data): HouseResidentHistory
    {
        return $this->houseResidentHistoryRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->houseResidentHistoryRepository->delete($id);
    }

    public function findById(int $id): HouseResidentHistory
    {
        return $this->houseResidentHistoryRepository->findById($id);
    }
}
