<?php

use App\Http\Controllers\CMS\BookingController;
use App\Http\Controllers\CMS\PackagesController;
use App\Http\Controllers\CMS\AuthController;
use App\Http\Controllers\CMS\TailorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/tailor')->controller(TailorController::class)->group(function () {
    Route::get('/', 'getAllData');
    Route::post('/create', 'createData');
    Route::get('/get/{id}', 'getDataById');
    Route::post('/update/{id}', 'updateData');
    Route::delete('/delete/{id}', 'deleteData');
});

Route::prefix('v1/packages')->controller(PackagesController::class)->group(function () {
    Route::get('/', 'getAllData');
    Route::get('/get/package/tailor', 'getDataByTailor');
    Route::post('/create', 'createData');
    Route::get('/get/{id}', 'getDataById');
    Route::get('/get/tailor/{id_tailor}', 'getDataPacketByTailor');
    Route::post('/update/{id}', 'updateData');
    Route::delete('/delete/{id}', 'deleteData');
});

Route::prefix('v1/auth')->controller(AuthController::class)->group(function () {
    Route::get('/', 'getAllData');
    Route::post('/createData', 'createData');
    Route::get('/getDataById/{id}', 'getDataById');
    Route::post('/updateData/{id}', 'updateData');
    Route::delete('/deleteData/{id}', 'deleteData');
    Route::post('/login', 'login');
});
Route::prefix('v1/booking')->controller(BookingController::class)->group(function () {
    Route::get('/', 'getAllData');
    Route::post('/create', 'createData');
    Route::get('/get/{id}', 'getDataById');
    Route::post('/update/{id}', 'updateData');
    Route::delete('/delete/{id}', 'deleteData');
});
