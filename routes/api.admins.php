<?php

use Illuminate\Support\Facades\Route;

Route::controller(AuthenticateController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('send-email-reset', 'sendEmailResetPassword')->name('send-email-reset');
    Route::post('reset-password', 'resetPassword')->name('reset-password');
    Route::post('check-expired', 'checkExpired')->name('check-expired');
});

Route::group(['middleware' => ['auth:admins']], function () {
    Route::apiResource('accounts', AdminController::class);
    Route::controller(AdminController::class)->group(function () {
        Route::post('logout', 'logout')->name('logout');
        Route::post('change-password', 'changePassword')->name('change-password');
    });
    Route::apiResource('service-menus', ServiceMenuController::class)->except('destroy');
});
