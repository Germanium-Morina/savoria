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
use Illuminate\Support\Facades\Gate;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User as UserModel;
use App\Policies\OrderPolicy;
use App\Policies\ReservationPolicy;
use App\Policies\UserPolicy;

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
        // Register policies
        Gate::policy(Order::class, OrderPolicy::class);
        Gate::policy(Reservation::class, ReservationPolicy::class);
        Gate::policy(UserModel::class, UserPolicy::class);

        // Allow admin role to bypass permission checks
        Gate::before(function ($user, $ability) {
            if (method_exists($user, 'hasRole') && $user->hasRole('admin')) {
                return true;
            }
        });
    }
}
