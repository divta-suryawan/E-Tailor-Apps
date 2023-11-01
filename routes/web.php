<?php

use App\Http\Controllers\CMS\ExampleController;
use Illuminate\Support\Facades\Route;

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
    return view('cms/tailor');
});
Route::get('/booking', function () {
    return view('cms/booking');
});

Route::get('example', [ExampleController::class, 'getAllData']);
