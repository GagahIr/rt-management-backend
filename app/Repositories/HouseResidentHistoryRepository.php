<?php

namespace App\Repositories;

use App\Models\House;
use App\Models\HouseResidentHistory;
use App\Models\Resident;
use App\Repositories\Interfaces\HouseResidentHistoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class HouseResidentHistoryRepository implements HouseResidentHistoryRepositoryInterface
{
    protected HouseResidentHistory $houseResidentHistoryModel;
    protected House $houseModel;
    protected Resident $residentModel;

    public function __construct(HouseResidentHistory $houseResidentHistoryModel, House $houseModel, Resident $residentModel)
    {
        $this->houseResidentHistoryModel = $houseResidentHistoryModel;
        $this->houseModel = $houseModel;
        $this->residentModel = $residentModel;
    }

    public function getAll(): Collection
    {
       return $this->houseResidentHistoryModel->with(['house', 'resident'])->get();
    }

    public function create(array $data): HouseResidentHistory
    {
        return $this->houseResidentHistoryModel->create($data);
    }

    public function update(int $id, array $data): HouseResidentHistory
    {
        $model = $this->houseResidentHistoryModel->findOrFail($id);

        $model->update($data);

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->houseResidentHistoryModel->findOrFail($id);

        $model->delete();

        return true;
    }

    public function findById(int $id): HouseResidentHistory
    {
        return $this->houseResidentHistoryModel->findOrFail($id);
    }

    // public function getHouse(): array
    // {
    //     return $this->houseModel->pluck('house_code', 'id');    
    // }

    // public function getResident(): array
    // {
    //     return $this->residentModel->pluck('full_name', 'id');    
    // }
}
