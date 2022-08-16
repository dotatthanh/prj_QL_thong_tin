<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TransmissionStreamController;
use App\Http\Controllers\TvStreamContoller;

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
    return redirect('login');
});

Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');
	Route::get('/dashboard/statistic', [DashboardController::class, 'statistic'])->name('dashboard.statistic');
	
	Route::resource('users', UserController::class);
	Route::get('/users/view-change-password/{user}', [UserController::class, 'viewChangePassword'])->name('users.view-change-password');
	Route::post('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');

	Route::resource('roles', RoleController::class);
	Route::resource('permissions', PermissionController::class);
	Route::resource('units', UnitController::class);
	Route::resource('transmission_streams', TransmissionStreamController::class);
	Route::get('/transmission_stream/print', [TransmissionStreamController::class, 'print'])->name('transmission_streams.print');
	Route::post('/transmission_stream/import-excel', [TransmissionStreamController::class, 'importExcel'])->name('transmission_streams.import-excel');

	Route::resource('tv_streams', TvStreamContoller::class);
	Route::get('/tv_stream/print', [TvStreamContoller::class, 'print'])->name('tv_streams.print');
	Route::post('/tv_stream/import-excel', [TvStreamContoller::class, 'importExcel'])->name('tv_streams.import-excel');

	Route::resource('stations', StationController::class);
	Route::get('/station/system-tree', [StationController::class, 'systemTree'])->name('station.system-tree');
	Route::post('/station/get-unit-child-list', [StationController::class, 'getUnitChildList']);

	Route::resource('devices', DeviceController::class);
	Route::get('/device/transmission/{id}', [DeviceController::class, 'transmission'])->name('device.transmission');
	Route::get('/device/television/{id}', [DeviceController::class, 'television'])->name('device.television');
	Route::post('/device/get-device-transmission-by-station', [DeviceController::class, 'getDeviceTransmissionByStation'])->name('device.get-device-transmission-by-station');
	Route::post('/device/get-device-television-by-station', [DeviceController::class, 'getDeviceTelevisionByStation'])->name('device.get-device-television-by-station');
	Route::resource('softwares', SoftwareController::class);
	Route::resource('documents', DocumentController::class);
	Route::get('/document/document-video', [DocumentController::class, 'documentVideo'])->name('document.video');
	Route::get('/document/read', [DocumentController::class, 'documentRead'])->name('document.read');
	Route::get('/document/english', [DocumentController::class, 'documentEnglish'])->name('document.english');

	Route::post('/document/store-video', [DocumentController::class, 'storeVideo'])->name('document.store.video');
});

require __DIR__.'/auth.php';
