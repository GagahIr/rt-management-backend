<?php

namespace App\Providers;

use App\Repositories\ExpenseRepository;
use App\Repositories\HouseRepository;
use App\Repositories\HouseResidentHistoryRepository;
use App\Repositories\Interfaces\ExpenseRepositoryInterface;
use App\Repositories\Interfaces\HouseRepositoryInterface;
use App\Repositories\Interfaces\HouseResidentHistoryRepositoryInterface;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\PaymentTypesRepositoryInterface;
use App\Repositories\Interfaces\ResidentRepositoryInterface;
use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentTypesRepository;
use App\Repositories\ResidentRepository;
use App\Services\ExpenseService;
use App\Services\HouseResidentHistoryService;
use App\Services\HouseService;
use App\Services\Interfaces\ExpenseServiceInterface;
use App\Services\Interfaces\HouseResidentHistoryServiceInterface;
use App\Services\Interfaces\HouseServiceInterface;
use App\Services\Interfaces\InvoiceServiceInterface;
use App\Services\Interfaces\PaymentTypesServiceInterface;
use App\Services\Interfaces\ResidentServiceInterface;
use App\Services\InvoiceService;
use App\Services\PaymentTypesService;
use App\Services\ResidentService;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HouseRepositoryInterface::class, HouseRepository::class);
        $this->app->bind(HouseServiceInterface::class, HouseService::class);

        $this->app->bind(ResidentRepositoryInterface::class, ResidentRepository::class);
        $this->app->bind(ResidentServiceInterface::class, ResidentService::class);

        $this->app->bind(HouseResidentHistoryRepositoryInterface::class, HouseResidentHistoryRepository::class);
        $this->app->bind(HouseResidentHistoryServiceInterface::class, HouseResidentHistoryService::class);

        $this->app->bind(PaymentTypesRepositoryInterface::class, PaymentTypesRepository::class);
        $this->app->bind(PaymentTypesServiceInterface::class, PaymentTypesService::class);

        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(InvoiceServiceInterface::class, InvoiceService::class);

        $this->app->bind(ExpenseRepositoryInterface::class, ExpenseRepository::class);
        $this->app->bind(ExpenseServiceInterface::class, ExpenseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }
}
