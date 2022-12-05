<?php

use Illuminate\Support\Facades\Route;

Route::controller(AuthenticateController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('send-email-reset', 'sendEmailResetPassword')->name('send-email-reset');
    Route::post('reset-password', 'resetPassword')->name('reset-password');
    Route::post('check-expired', 'checkExpired')->name('check-expired');
});

Route::group(['middleware' => ['auth:admins', 'role']], function () {
    Route::apiResource('accounts', AdminController::class);
    Route::apiResource('settings', SettingController::class);
    Route::controller(AdminController::class)->group(function () {
        Route::post('logout', 'logout')->name('logout');
        Route::post('change-password', 'changePassword')->name('change-password');
    });
    Route::apiResource('service-menus', ServiceMenuController::class)->except('destroy');
    Route::apiResource('roles', RoleController::class)->except('destroy');
    Route::controller(ImageController::class)->group(function () {
        Route::get('images', 'index')->name('images.index');
        Route::post('images/pre-signed-image', 'preSignedImage')->name('images.pre-signed-image');
        Route::post('images/store-public-image', 'storePublicImage')->name('images.storePublicImage');
        Route::delete('images/delete-path', 'deletePath')->name('images.deletePath');
    });
});
