<?php

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/admin', function () {
    return view('admin.dashboard.index');
});

Route::get('/city', [App\Http\Controllers\CityController::class, 'index'])->name('admin.dashboard.city');
Route::post('/city/add', [App\Http\Controllers\CityController::class, 'storeCity'])->name('admin.storeCity');
Route::get('/city/deleteCity/{id}', [App\Http\Controllers\CityController::class, 'deleteCity'])->name('admin.deleteCity');
Route::post('/city/update/{id}', [App\Http\Controllers\CityController::class, 'updateCity'])->name('admin.updateCity');


Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.dashboard.role');
Route::post('/role/add', [App\Http\Controllers\RoleController::class, 'storeRole'])->name('admin.storeRole');
Route::get('/role/deleteRole/{id}', [App\Http\Controllers\RoleController::class, 'deleteRole'])->name('admin.deleteRole');
Route::post('/Role/update/{id}', [App\Http\Controllers\RoleController::class, 'updateRole'])->name('admin.updateRole');

Route::get('/status', [App\Http\Controllers\StatusController::class, 'index'])->name('admin.dashboard.status');
Route::post('/status/add', [App\Http\Controllers\StatusController::class, 'storeStatus'])->name('admin.storeStatus');
Route::get('/status/deleteStatus/{id}', [App\Http\Controllers\StatusController::class, 'deleteStatus'])->name('admin.deleteStatus');
Route::post('/status/update/{id}', [App\Http\Controllers\StatusController::class, 'updateStatus'])->name('admin.updateStatus');

Route::get('/jenisprogram', [App\Http\Controllers\JenisProgramController::class, 'index'])->name('admin.dashboard.jenisprogram');
Route::post('/jenisprogram/add', [App\Http\Controllers\JenisProgramController::class, 'storeJenis'])->name('admin.storeJenisProgram');
Route::get('/jenisprogram/deleteJenis/{id}', [App\Http\Controllers\JenisProgramController::class, 'deleteJenis'])->name('admin.deleteJenis');
Route::post('/jenisprogram/update/{id}', [App\Http\Controllers\JenisProgramController::class, 'updateJenis'])->name('admin.updateJenis');

Route::group(['middleware' => 'revalidate'], function () {
    Route::group(['middleware' => 'auth:account'], function () {

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard.index');
    });
    // Login untuk trader
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'formLogin'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});
