<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    Artisan::call('storage:link');
    // Artisan::call('telescope:install');
    // Artisan::call('vendor:publish --tag=telescope-migrations');
    // Artisan::call('optimize:clear');
    // Artisan::call('migrate');
    // Artisan::call('db:seed --class=AddSuperAdminSeeder');

    // return view('welcome');
});
