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

Route::get('example' , [ExampleController::class , 'getAllData']);

// ===== UI =====
Route::get('/app', function () {
    return view('web/index');
});

Route::get('/app/rumah-jahit/{parameter?}', function ($parameter = null) {
    if ($parameter) {
        return view('web/rumahJahitTailor');
    } else {
        return view('web/rumahJahit');
    }
});

Route::get('/app/rumah-jahit/{parameter?}/janji-temu', function() {
    return view('web/janjiTemu');
});


Route::get('/app/tentang-kami', function () {
    return view('web/tentangKami');
});

Route::get('/app/bergabung', function () {
    return view('web/bergabung');
});