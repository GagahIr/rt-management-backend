<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\HouseResidentHistoriesRequest;
use App\Services\Interfaces\HouseResidentHistoryServiceInterface;
use Illuminate\Http\JsonResponse;

final class HouseResidentHistoryController extends ApiController
{
    protected HouseResidentHistoryServiceInterface $HouseResidentHistoryService;

    public function __construct(HouseResidentHistoryServiceInterface $HouseResidentHistoryService)
    {
        $this->HouseResidentHistoryService = $HouseResidentHistoryService;
    }

    public function getAll(): JsonResponse
    {
        try {
            $result = $this->HouseResidentHistoryService->getAll();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function store(HouseResidentHistoriesRequest $request): JsonResponse
    {
        try {
            $result = $this->HouseResidentHistoryService->create($request->validated());
            return $this->response('Data berhasil ditambahkan.', $result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function update(int $id, HouseResidentHistoriesRequest $request): JsonResponse
    {
        try {
            $this->HouseResidentHistoryService->update($id, $request->validated());
            return $this->response('Data berhasil diubah.');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->HouseResidentHistoryService->delete($id);
            return $this->response('Data berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getCount(): JsonResponse
    {
        try {
            $result = $this->HouseResidentHistoryService->getAll()->count();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
