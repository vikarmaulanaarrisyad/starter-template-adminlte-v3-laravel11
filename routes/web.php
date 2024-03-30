<?php

use App\Http\Controllers\{
    DashboardController,
    SettingController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/setting', [SettingController::class, 'index'])
    ->name('setting.index');
Route::put('/setting/{setting}', [SettingController::class, 'update'])
    ->name('setting.update');
