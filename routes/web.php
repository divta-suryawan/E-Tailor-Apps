<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMS\ExampleController;
use App\Http\Controllers\API\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('example' , [ExampleController::class , 'getAllData']);

Route::get('/dashboard', function () {
    return view('cms/dashboard');
});

Route::get('/users', [RegisterController::class, 'index']);