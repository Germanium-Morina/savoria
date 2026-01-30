<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\MenuServiceInterface;
use App\Services\MenuService;
use App\Services\Contracts\CartServiceInterface;
use App\Services\CartService;
use App\Services\Contracts\ReservationServiceInterface;
use App\Services\ReservationService;
use App\Services\OrderService;
use App\Services\Contracts\OrderServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MenuServiceInterface::class, MenuService::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
