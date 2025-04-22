<?php

namespace App\Providers;

use App\Exceptions\CustomExceptionHandler;
use App\ServiceImpl\BudgetServiceImpl;
use App\ServiceImpl\CategoryServiceImpl;
use App\ServiceImpl\ExpenseServiceImpl;
use App\ServiceImpl\ReportServiceImpl;
use App\Services\BudgetService;
use App\Services\CategoryService;
use App\Services\ExpenseService;
use App\Services\ReportService;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExceptionHandler::class, CustomExceptionHandler::class);
        $this->app->bind(CategoryService::class, CategoryServiceImpl::class);
        $this->app->bind(BudgetService::class, BudgetServiceImpl::class);
        $this->app->bind(ExpenseService::class,ExpenseServiceImpl::class);
        $this->app->bind(ReportService::class,ReportServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
