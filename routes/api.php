<?php

use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\HouseController as ApiHouseController;
use App\Http\Controllers\Api\ResidentController as ApiResidentController;
use App\Http\Controllers\Api\HouseResidentHistoryController as HouseResidentHistoryController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentTypesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('house')->group(function () {
    Route::get('/', [ApiHouseController::class, 'getAll']);
    Route::post('/', [ApiHouseController::class, 'store']);
    Route::put('/{id}', [ApiHouseController::class, 'update']);
    Route::delete('/{id?}', [ApiHouseController::class, 'destroy']);
    Route::get('/get-count', [ApiHouseController::class, 'getCount']);
});

Route::prefix('resident')->group(function () {
    Route::get('/', [ApiResidentController::class, 'getAll']);
    Route::post('/', [ApiResidentController::class, 'store']);
    Route::put('/{id}', [ApiResidentController::class, 'update']);
    Route::delete('/{id?}', [ApiResidentController::class, 'destroy']);
    Route::get('/get-count', [ApiResidentController::class, 'getCount']);
});

Route::prefix('resident-house')->group(function () {
    Route::get('/', [HouseResidentHistoryController::class, 'getAll']);
    Route::post('/', [HouseResidentHistoryController::class, 'store']);
    Route::put('/{id}', [HouseResidentHistoryController::class, 'update']);
    Route::delete('/{id?}', [HouseResidentHistoryController::class, 'destroy']);
    Route::get('/get-count', [HouseResidentHistoryController::class, 'getCount']);
});

Route::prefix('payment-type')->group(function () {
    Route::get('/', [PaymentTypesController::class, 'getAll']);
    Route::post('/', [PaymentTypesController::class, 'store']);
    Route::put('/{id}', [PaymentTypesController::class, 'update']);
    Route::delete('/{id?}', [PaymentTypesController::class, 'destroy']);
    Route::get('/get-count', [PaymentTypesController::class, 'getCount']);
});

Route::prefix('expense')->group(function () {
    Route::get('/', [ExpenseController::class, 'getAll']);
    Route::post('/', [ExpenseController::class, 'store']);
    Route::put('/{id}', [ExpenseController::class, 'update']);
    Route::delete('/{id}', [ExpenseController::class, 'destroy']);

    Route::get('/report/{month}/{year}', [ExpenseController::class, 'getByMonthYear']);
    Route::get('/summary/{year}', [ExpenseController::class, 'getYearlySummary']);
});

Route::prefix('invoice')->group(function () {
    Route::get('/', [InvoiceController::class, 'getAll']);
    Route::get('/datatable', [InvoiceController::class, 'dataTable']);
    Route::post('/', [InvoiceController::class, 'store']);
    Route::post('/advance', [InvoiceController::class, 'storeAdvance']);
    Route::put('/{id}', [InvoiceController::class, 'update']);
    Route::delete('/{id}', [InvoiceController::class, 'destroy']);

    Route::get('/report/{month}/{year}', [InvoiceController::class, 'getByMonthYear']);
    Route::get('/summary/{year}', [InvoiceController::class, 'getYearlySummary']);
    Route::get('/occupied', [InvoiceController::class, 'getOccupiedHouses']);
    Route::post('/generate-bulk', [InvoiceController::class, 'generateBulk']);
    Route::get('/unpaid/{month}/{year}', [InvoiceController::class, 'unpaidList']);
});
