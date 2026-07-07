<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ResidentRequest;
use App\Services\Interfaces\ResidentServiceInterface;
use Illuminate\Http\JsonResponse;

final class ResidentController extends ApiController
{
    protected ResidentServiceInterface $residentService;

    public function __construct(ResidentServiceInterface $residentService)
    {
        $this->residentService = $residentService;
    }

    public function getAll(): JsonResponse
    {
        try {
            $result = $this->residentService->getAll();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function store(ResidentRequest $request): JsonResponse
    {
        try {
            $result = $this->residentService->create($request->validated(), $request->file('id_photo'));
            return $this->response('Data berhasil ditambahkan.', $result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function update(int $id, ResidentRequest $request): JsonResponse
    {
        try {
            $this->residentService->update($id, $request->validated(), $request->file('id_photo'));
            return $this->response('Data berhasil diubah.');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->residentService->delete($id);
            return $this->response('Data berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getCount(): JsonResponse
    {
        try {
            $result = $this->residentService->getAll()->count();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
