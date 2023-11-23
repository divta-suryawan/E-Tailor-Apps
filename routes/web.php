<?php

use App\Http\Controllers\CMS\AuthController;
use App\Http\Controllers\CMS\ExampleController;
use App\Http\Controllers\CMS\TailorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

//* cms
Route::middleware('guest')->group(function () {
    Route::get('/cms/login', function () {
        return view('cms/auth/login');
    });
    Route::post('/login' , [AuthController::class, 'login']);
});


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/cms/tailor', function () {
        return view('cms.tailor');
    });
    Route::get('/cms/packages', function () {
        return view('cms.packages');
    });
    Route::get('/cms/usermanagement', function () {
        return view('cms/usermanagement');
    });
    Route::post('/logout' , [AuthController::class, 'logout']);

    Route::prefix('api/v1/tailor')->controller(TailorController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
    });
});
// *end cms


Route::get('example', [ExampleController::class, 'getAllData']);

// ===== UI =====
Route::get('/', function () {
    return view('web/index');
});
Route::get('/booking', function () {
    return view('cms/booking');
});

Route::get('/paket', function () {
    return view('web/paketTailor');
});

Route::get('/rumah-jahit/{parameter}', function ($parameter) {
    if (Str::isUuid($parameter)) {
        return view('web/rumahJahitTailor');
    } else {
        return view('web/notFound');
    }
});

Route::get('/rumah-jahit', function () {
    return view('web/rumahJahit');
});

Route::get('/rumah-jahit/{parameter?}/janji-temu', function () {
    return view('web/janjiTemu');
});

Route::get('/tentang-kami', function () {
    return view('web/tentangKami');
});

Route::get('/bergabung', function () {
    return view('web/bergabung');
});
