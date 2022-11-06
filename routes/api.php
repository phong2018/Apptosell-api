<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('health/redis', 'Api\HealthCheckController@checkHealthRedis')->name('redis-check');
Route::get('health/database', 'Api\HealthCheckController@checkDBConnect')->name('check-db-connect');
