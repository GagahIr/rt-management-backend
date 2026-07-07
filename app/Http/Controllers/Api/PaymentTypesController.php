<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\PaymentTypesRequest;
use App\Services\Interfaces\PaymentTypesServiceInterface;
use Illuminate\Http\JsonResponse;

final class PaymentTypesController extends ApiController
{
    protected PaymentTypesServiceInterface $paymentTypesService;

    public function __construct(PaymentTypesServiceInterface $paymentTypesService)
    {
        $this->paymentTypesService = $paymentTypesService;
    }

    public function getAll(): JsonResponse
    {
        try {
            $result = $this->paymentTypesService->getAll();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function store(PaymentTypesRequest $request): JsonResponse
    {
        try {
            $result = $this->paymentTypesService->create(
                $request->validated()
            );
            return $this->response('Data berhasil ditambahkan.', $result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function update(int $id, PaymentTypesRequest $request): JsonResponse
    {
        try {
            $this->paymentTypesService->update($id, $request->all());
            return $this->response('Data berhasil diubah.');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->paymentTypesService->delete($id);
            return $this->response('Data berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function getCount(): JsonResponse
    {
        try {
            $result = $this->paymentTypesService->getAll()->count();
            return $this->response($result);
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
