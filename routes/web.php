<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FindController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login_store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logouts'])->name('logout_destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('locations', LocationController::class)->except('show')->names('location');

    Route::get('inventories/print', [InventoryController::class, 'print'])->name('inventories.print');
    Route::get('inventories/export', [InventoryController::class, 'export'])->name('inventories.export');
    Route::resource('inventories', InventoryController::class)->except('show')->names('inventories');

    Route::resource('admin', AdminController::class)->except('show')->names('admin');
    Route::get('/find', [FindController::class, 'index'])->name('find.index');

    Route::resource('notifications', NotificationController::class)->names('notifications');
});
