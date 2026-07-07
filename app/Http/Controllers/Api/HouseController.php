<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\HouseRequest;
use App\Services\Interfaces\HouseServiceInterface;
use Illuminate\Http\JsonResponse;

final class HouseController extends ApiController
{
    protected HouseServiceInterface $houseService;

    public function __construct(HouseServiceInterface $houseService)
    {
        $this->houseService = $houseService;
    }

    public function getAll(): JsonResponse
    {
        try {
            $result = $this->houseService->getAll();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function store(HouseRequest $request): JsonResponse
    {
        try {
            $result = $this->houseService->create(
                $request->validated()
            );
            return $this->response('Data berhasil ditambahkan.', $result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function update(int $id, HouseRequest $request): JsonResponse
    {
        try {
            $this->houseService->update($id, $request->all());
            return $this->response('Data berhasil diubah.');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->houseService->delete($id);
            return $this->response('Data berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getCount(): JsonResponse
    {
        try {
            $result = $this->houseService->getAll()->count();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
