<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\WebAuthController;

// Session (cookie) based auth endpoints for Sanctum
Route::post('login', [WebAuthController::class, 'login'])->name('login');
Route::post('logout', [WebAuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {
    Route::get('categories', \App\Http\Livewire\Admin\CategoriesList::class)->name('admin.categories.list');
    Route::get('categories/create', \App\Http\Livewire\Admin\CategoryForm::class)->name('admin.categories.create');
    Route::get('categories/{id}/edit', \App\Http\Livewire\Admin\CategoryForm::class)->name('admin.categories.edit');

    Route::get('menu', \App\Http\Livewire\Admin\MenuItemsList::class)->name('admin.menu.list');
    Route::get('menu/create', \App\Http\Livewire\Admin\MenuItemForm::class)->name('admin.menu.create');
    Route::get('menu/{id}/edit', \App\Http\Livewire\Admin\MenuItemForm::class)->name('admin.menu.edit');

    Route::get('reservations', \App\Http\Livewire\Admin\ReservationsList::class)->name('admin.reservations.list');
});
