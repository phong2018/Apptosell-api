<?php

use Illuminate\Support\Facades\Route;
use Mi\L5Swagger\Http\Controllers\SwaggerJsonController;

Route::get('/api/swagger/demo-swagger', [SwaggerJsonController::class, 'demoSwagger']);
