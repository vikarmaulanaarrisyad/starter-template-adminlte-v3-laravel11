<?php

use App\Http\Controllers\{
    AksesRoleController,
    DashboardController,
    PermissionController,
    PermissionGroupController,
    RoleController,
    SettingController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function () {

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

    Route::controller(PermissionController::class)->group(function () {
        Route::get('/permissions/data', 'data')->name('permission.data');
        Route::get('/permissions', 'index')->name('permission.index');
        Route::get('/permissions/{permission}/detail', 'detail')->name('permission.detail');
        Route::get('/permissions/{permission}', 'edit')->name('permission.edit');
        Route::put('/permissions/{permission}/update', 'update')->name('permission.update');
        Route::post('/permissions', 'store')->name('permission.store');
        Route::delete('/permissions/{permission}/destroy', 'destroy')->name('permission.destroy');
    });

    // route permissionGroup
    Route::controller(PermissionGroupController::class)->group(function () {
        Route::get('/permissiongroups/data', 'data')->name('permissiongroups.data');
        Route::get('/permissiongroups', 'index')->name('permissiongroups.index');
        Route::get('/permissiongroups/{permissionGroup}/detail', 'detail')->name('permissiongroups.detail');
        Route::get('/permissiongroups/{permissionGroup}', 'edit')->name('permissiongroups.edit');
        Route::put('/permissiongroups/{permissionGroup}/update', 'update')->name('permissiongroups.update');
        Route::post('/permissiongroups', 'store')->name('permissiongroups.store');
        Route::delete('/permissiongroups/{permissionGroup}/destroy', 'destroy')->name('permissiongroups.destroy');
    });

    Route::controller(AksesRoleController::class)->group(function () {
        Route::get('/aksesrole/data', 'data')->name('aksesrole.data');
        Route::get('/aksesrole', 'index')->name('aksesrole.index');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('/setting', 'index')->name('setting.index');
        Route::put('/setting/{setting}', 'update')->name('setting.update');
    });
});
