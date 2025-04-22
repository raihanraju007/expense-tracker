<?php

namespace App\Providers;

use App\Services\BudgetService;
use App\Services\CategoryService;
use App\ServiceImpl\BudgetServiceImpl;
use Illuminate\Support\ServiceProvider;
use App\ServiceImpl\CategoryServiceImpl;
use App\Exceptions\CustomExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
