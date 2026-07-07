<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;

class ApiController extends Controller {

    public function response($message, $data = null, ?int $code = null): JsonResponse
    {
        $code = $code ?? Response::HTTP_OK;
        $response = $this->buildResponse($message, $data);
        return response()->json($response, $code);
    }

    protected function buildResponse($message, $data = null): array
    {
        $response = [];
        if (is_array($message) || is_object($message)) {
            $response['data'] = $message;
        } else {
            $response['message'] = $message;
        }
        if ($data !== null) {
            $response['data'] = $data;
        } elseif (is_array($message)) {
            $response['data'] = $message;
        }
        return $response;
    }

    public function error($e): JsonResponse
    {
        $code = Response::HTTP_BAD_REQUEST;
        $response = [
            'message' => 'An error occurred.'
        ];

        if ($e instanceof ModelNotFoundException) {
            $response['message'] = 'Data not found.';
            $code = Response::HTTP_NOT_FOUND;
        } elseif ($e instanceof ValidationException) {
            $response['message'] = $e->getMessage();
            $errors = $e->errors();
            foreach ($errors as $field => $messages) {
                $errors[$field] = $messages[0];
            }
            $response['errors'] = $errors;
        } elseif ($e instanceof UnauthorizedException) {
            $response['message'] = $e->getMessage() ?? 'Unauthorized.';
            $code = Response::HTTP_UNAUTHORIZED;
        } elseif ($e instanceof InvalidArgumentException) {
            $response['message'] = $e->getMessage() ?? 'Invalid Argument.';
            $code = Response::HTTP_BAD_REQUEST;
        } else if ($e->getCode() >= 400 && $e->getCode() < 500) {
            $response['message'] = $e->getMessage() ?? $response['message'];
        } else {
            Log::error($e);
            $response['message'] = $e->getMessage().' - '.$e->getFile().'::'.$e->getLine();
        }

        return response()->json($response, $code);
    }
}
