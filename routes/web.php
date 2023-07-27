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



Route::group(['middleware' => 'revalidate'], function () {
    Route::group(['middleware' => ['auth:account', 'account-access:Commerce']], function () {

        Route::get('/commerce', [App\Http\Controllers\Commerce\LaporanCommerceController::class, 'index'])->name('commerce.laporan.index');
        Route::get('/draft', [App\Http\Controllers\Commerce\LaporanCommerceController::class, 'draft'])->name('commerce.laporan.draft');
        Route::get('/commerce/laporankonstruksi', [App\Http\Controllers\LaporanKonstruksiController::class, 'index'])->name('commerce.konstruksi.index');
        Route::get('/commerce/add/konstruksi/{id}', [App\Http\Controllers\Commerce\LaporanCommerceController::class, 'add_konstruksi'])->name('commerce.laporan.add_konstruksi');
        Route::post('/commerce/add/storekonstruksi/{id}', [App\Http\Controllers\Commerce\LaporanCommerceController::class, 'store_konstruksi'])->name('commerce.laporan.store_konstruksi');
        Route::get('/commerce/laporanmaintenance', [App\Http\Controllers\LaporanMaintenanceController::class, 'index'])->name('commerce.maintenance.index');
        Route::get('/commerce/delete/{id}', [App\Http\Controllers\Commerce\LaporanCommerceController::class, 'deleteLaporanCommerce'])->name('commerce.delete_laporan_commerce');

        Route::get('/commerce/laporanmaintenance', [App\Http\Controllers\LaporanMaintenanceController::class, 'index'])->name('commerce.maintenance.index');
        Route::get('/commerce/add/maintenance/{id}', [App\Http\Controllers\Commerce\LaporanCommerceController::class, 'add_maintenance'])->name('commerce.laporan.add_maintenance');
        Route::post('/commerce/add/storemaintenance/{id}', [App\Http\Controllers\Commerce\LaporanCommerceController::class, 'store_maintenance'])->name('commerce.laporan.store_maintenance');
        Route::get('/commerce/edit/{id}', [App\Http\Controllers\Commerce\LaporanCommerceController::class, 'edit'])->name('commerce.laporan.edit');
        Route::post('/commerce/update/{id}', [App\Http\Controllers\Commerce\LaporanCommerceController::class, 'update'])->name('commerce.laporan.update');
    });

    Route::group(['middleware' => ['auth:account', 'account-access:Maintenance']], function () {

        // Route::get('/commerce', function () {
        //     return view('commerce.dashboard.index');
        // });
    });

    Route::group(['middleware' => ['auth:account', 'account-access:Konstruksi']], function () {

        Route::get('/laporanconstruct', [App\Http\Controllers\LaporanKonstruksiController::class, 'index'])->name('konstruksi.laporanKonstruksi.index');
        Route::get('/konstruksi/delete/{id}', [App\Http\Controllers\LaporanKonstruksiController::class, 'deleteLaporanKonstruksi'])->name('konstruksi.laporan_konstruksi_delete');
        Route::get('/konstruksi/add/', [App\Http\Controllers\LaporanKonstruksiController::class, 'addLaporanKonstruksi'])->name('konstruksi.laporan_konstruksi_add');
        Route::post('konstruksi/add/success', [App\Http\Controllers\LaporanKonstruksiController::class, 'storeLaporanKonstruksi'])->name('konstruksi.storeLaporanKonstruksi');
        Route::get('/konstruksi/edit/{id}', [App\Http\Controllers\LaporanKonstruksiController::class, 'editLaporanKonstruksi'])->name('konstruksi.laporan_konstruksi_edit');
        Route::post('/konstruksi/edit/{id}/success', [App\Http\Controllers\LaporanKonstruksiController::class, 'updateLaporanKonstruksi'])->name('konstruksi.updateLaporanKonstruksi');
    });

    Route::group(['middleware' => ['auth:account', 'account-access:Admin']], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard.index');
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

        Route::get('/statustagihan', [App\Http\Controllers\StatusTagihanController::class, 'index'])->name('admin.dashboard.statustagihan');
        Route::post('/statustagihan/add', [App\Http\Controllers\StatusTagihanController::class, 'storeStatus'])->name('admin.storestatustagihan');
        Route::get('/statustagihan/deleteJenis/{id}', [App\Http\Controllers\StatusTagihanController::class, 'deleteStatus'])->name('admin.deletestatustagihan');
        Route::post('/statustagihan/update/{id}', [App\Http\Controllers\StatusTagihanController::class, 'updateStatus'])->name('admin.updatestatustagihan');

        Route::get('/jenis-order', [App\Http\Controllers\JenisOrderController::class, 'index'])->name('admin.dashboard.jenisOrder');
        Route::post('/jenis-order/add', [App\Http\Controllers\JenisOrderController::class, 'storeJenisOrder'])->name('admin.storeJenisOrder');
        Route::get('/jenis-order/deleteJenisOrder/{id}', [App\Http\Controllers\JenisOrderController::class, 'deleteJenisOrder'])->name('admin.deleteJenisOrder');
        Route::post('/jenis-order/update/{id}', [App\Http\Controllers\JenisOrderController::class, 'updateJenisOrder'])->name('admin.updateJenisOrder');

        Route::get('/jenisprogram', [App\Http\Controllers\JenisProgramController::class, 'index'])->name('admin.dashboard.jenisprogram');
        Route::post('/jenisprogram/add', [App\Http\Controllers\JenisProgramController::class, 'storeJenis'])->name('admin.storeJenisProgram');
        Route::get('/jenisprogram/deleteJenis/{id}', [App\Http\Controllers\JenisProgramController::class, 'deleteJenis'])->name('admin.deleteJenis');
        Route::post('/jenisprogram/update/{id}', [App\Http\Controllers\JenisProgramController::class, 'updateJenis'])->name('admin.updateJenis');

        Route::get('/statuspekerjaan', [App\Http\Controllers\StatusPekerjaanController::class, 'index'])->name('admin.dashboard.status_pekerjaan');
        Route::post('/statuspekerjaan/add', [App\Http\Controllers\StatusPekerjaanController::class, 'storeStatusPekerjaan'])->name('admin.storeStatusPekerjaan');
        Route::get('/statuspekerjaan/deleteJenis/{id}', [App\Http\Controllers\StatusPekerjaanController::class, 'deleteStatusPekerjaan'])->name('admin.deleteStatusPekerjaan');
        Route::post('/statuspekerjaan/update/{id}', [App\Http\Controllers\StatusPekerjaanController::class, 'updateStatusPekerjaan'])->name('admin.updateStatusPekerjaan');

        Route::get('/tipekemitraan', [App\Http\Controllers\TipeKemitraanController::class, 'index'])->name('admin.dashboard.tipe_kemitraan');
        Route::post('/tipekemitraan/add', [App\Http\Controllers\TipeKemitraanController::class, 'storeTipeKemitraan'])->name('admin.storeTipeKemitraan');
        Route::get('/tipekemitraan/deleteJenis/{id}', [App\Http\Controllers\TipeKemitraanController::class, 'deleteTipeKemitraan'])->name('admin.deleteTipeKemitraan');
        Route::post('/tipekemitraan/update/{id}', [App\Http\Controllers\TipeKemitraanController::class, 'updateTipeKemitraan'])->name('admin.updateTipeKemitraan');

        Route::get('/tipeprovisioning', [App\Http\Controllers\TipeProvisioningController::class, 'index'])->name('admin.dashboard.tipe_provisioning');
        Route::post('/tipeprovisioning/add', [App\Http\Controllers\TipeProvisioningController::class, 'storeTipeProvisioning'])->name('admin.storeTipeProvisioning');
        Route::get('/tipeprovisioning/deleteJenis/{id}', [App\Http\Controllers\TipeProvisioningController::class, 'deleteTipeProvisioning'])->name('admin.deleteTipeProvisioning');
        Route::post('/tipeprovisioning/update/{id}', [App\Http\Controllers\TipeProvisioningController::class, 'updateTipeProvisioning'])->name('admin.updateTipeProvisioning');

        Route::get('/mitra', [App\Http\Controllers\MitraController::class, 'index'])->name('admin.dashboard.mitra');
        Route::post('/mitra/add', [App\Http\Controllers\MitraController::class, 'storeMitra'])->name('admin.storeMitra');
        Route::get('/mitra/deleteJenis/{id}', [App\Http\Controllers\MitraController::class, 'deleteMitra'])->name('admin.deleteMitra');
        Route::post('/mitra/update/{id}', [App\Http\Controllers\MitraController::class, 'updateMitra'])->name('admin.updateMitra');


        Route::get('/laporanmaintenance', [App\Http\Controllers\LaporanMaintenanceController::class, 'index'])->name('maintenance.laporan_maintenance');
        Route::get('/laporanmaintenance/add', [App\Http\Controllers\LaporanMaintenanceController::class, 'addLaporanMaintenance'])->name('maintenance.addLaporanMaintenance');
        Route::post('/laporanmaintenance/store', [App\Http\Controllers\LaporanMaintenanceController::class, 'storeLaporanMaintenance'])->name('maintenance.storeLaporanMaintenance');
        Route::get('/laporanmaintenance/delete/{id}', [App\Http\Controllers\LaporanMaintenanceController::class, 'deleteLaporanMaintenance'])->name('maintenance.deleteLaporanMaintenance');
        Route::post('/laporanmaintenance/update/{id}', [App\Http\Controllers\LaporanMaintenanceController::class, 'updateLaporanMaintenance'])->name('maintenance.updateLaporanMaintenance');

        Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('admin.dashboard.account');
        Route::post('/account/add', [App\Http\Controllers\AccountController::class, 'storeAccount'])->name('admin.storeAccount');
        Route::get('/account/deleteAccount/{id}', [App\Http\Controllers\AccountController::class, 'deleteAccount'])->name('admin.deleteAccount');
        Route::post('/account/update/{id}', [App\Http\Controllers\AccountController::class, 'updateAccount'])->name('admin.updateAccount');

        Route::get('/laporankonstruksi', [App\Http\Controllers\LaporanKonstruksiController::class, 'index'])->name('admin.laporan_konstruksi');
        Route::get('/laporankonstruksi/delete/{id}', [App\Http\Controllers\LaporanKonstruksiController::class, 'deleteLaporanKonstruksi'])->name('admin.deleteLaporanKonstruksi');
        Route::get('/laporankonstruksi/add/', [App\Http\Controllers\LaporanKonstruksiController::class, 'addLaporanKonstruksi'])->name('admin.addLaporanKonstruksi');
        Route::post('laporankonstruksi/add/success', [App\Http\Controllers\LaporanKonstruksiController::class, 'storeLaporanKonstruksi'])->name('admin.storeLaporanKonstruksi');
        Route::get('/laporankonstruksi/edit/{id}', [App\Http\Controllers\LaporanKonstruksiController::class, 'editLaporanKonstruksi'])->name('admin.editLaporanKonstruksi');
        Route::post('/laporankonstruksi/edit/{id}/success', [App\Http\Controllers\LaporanKonstruksiController::class, 'updateLaporanKonstruksi'])->name('admin.updateLaporanKonstruksi');
    });
    // Login untuk account
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'formLogin'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});