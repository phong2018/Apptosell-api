<?php
use Illuminate\Support\Facades\Route;
use Mi\L5Swagger\Http\Controllers\SwaggerController;
use Mi\L5Swagger\Http\Controllers\SwaggerJsonController;

Route::get('/swagger-ui/{site}', [SwaggerController::class, 'index']);
Route::get('/api/swagger/{site}.json', [SwaggerJsonController::class, 'index'])->where('site', '(users|guests|factories|admins|web-line|webhook)');