<?php

use App\Http\Controllers\{
    DashboardController,
    RoleController,
    SettingController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::controller(RoleController::class)->group(function () {
    Route::get('/role/data', 'data')->name('role.data');
    Route::get('/role', 'index')->name('role.index');
    Route::get('/role/{role}/detail', 'detail')->name('role.detail');
    Route::get('/role/{role}', 'edit')->name('role.edit');
    Route::put('/role/{role}/update', 'update')->name('role.update');
    Route::post('/role', 'store')->name('role.store');
    Route::delete('/role/{role}/destroy', 'destroy')->name('role.destroy');
});


Route::controller(SettingController::class)->group(function () {
    Route::get('/setting', 'index')->name('setting.index');
    Route::put('/setting/{setting}', 'update')->name('setting.update');
});
