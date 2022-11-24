<?php

use Illuminate\Support\Facades\Route;
use Mi\L5Swagger\Http\Controllers\SwaggerJsonController;

Route::get('/api/swagger/demo-swagger', [SwaggerJsonController::class, 'demoSwagger']);

Route::group(['middleware' => ['auth:admins', 'role']], function () {
    Route::apiResource('accounts', AdminController::class);
    Route::controller(AdminController::class)->group(function () {
        Route::post('logout', 'logout')->name('logout');
        Route::post('change-password', 'changePassword')->name('change-password');
    });
    Route::apiResource('service-menus', ServiceMenuController::class)->except('destroy');
    Route::apiResource('roles', RoleController::class)->except('destroy');
});
