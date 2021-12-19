<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RouterController;
use App\Http\Controllers\CompanyController;

use App\Http\Controllers\ServerWatchDogController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\SubzoneController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('company')->name('company.')->group(function () {
    Route::get('/', [CompanyController::class, 'indexApi'])->name('index');
    Route::post('/add', [CompanyController::class, 'storeApi']);
    Route::delete('/delete/{id}', [CompanyController::class, 'destroyApi']);
    Route::get('/edit/{id}', [CompanyController::class, 'editApi']);
    Route::post('/edit/{id}', [CompanyController::class, 'updateApi']);
    //Route::get('/export/Pdf', [CompanyController::class, 'export'])->name('export');
});



Route::prefix('hotspot')->name('hotspot.')->group(function () {
    Route::get('/users', [RouterController::class, 'apiHotspotUsers'])->name('users');
    Route::get('/active', [RouterController::class, 'apiHotspotActiveUsers'])->name('active');
    Route::get('/online', [RouterController::class, 'apiHotspotOnlineUsers'])->name('online');
    Route::get('/online/remove/{serverId}/{userId}', [RouterController::class, 'hotspotOnlineUsersRemove'])->where('serverId', '[0-9]+');
    Route::get('/profiles', [RouterController::class, 'apiHotspotProfiles'])->name('profiles');
    Route::get('/profiles/remove/{serverId}/{packageName}', [RouterController::class, 'hotspotProfilesRemove'])->where('serverId', '[0-9]+');
    Route::get('/log', [RouterController::class, 'apiHotspotLog'])->name('log');
    Route::get('/mac-log', [RouterController::class, 'hotspotMacLog'])->name('mac-log');
    Route::get('/change-log', [RouterController::class, 'hotspotChangeLog'])->name('change-log');
    Route::get('/dhcp-leases', [RouterController::class, 'dhcpLeases'])->name('dhcp-leases');
});
Route::prefix('watchdog')->name('watchdog.')->group(function () {
    Route::get('/', [ServerWatchDogController::class, 'ApiList'])->name('index');
    Route::post('/add', [ServerWatchDogController::class, 'ApiStore']);
    Route::get('/delete/{id}', [ServerWatchDogController::class, 'ApiDelete']);
    Route::get('/edit/{id}', [ServerWatchDogController::class, 'ApiEdit']);
    Route::post('/edit/{id}', [ServerWatchDogController::class, 'ApiUpdate']);
    Route::get('/view/{id}', [ServerWatchDogController::class, 'ApiView']);

});

Route::prefix('zone')->name('zone.')->group(function () {
    Route::get('/', [ZoneController::class, 'indexApi'])->name('index');
    Route::post('/', [ZoneController::class, 'storeApi'])->name('store');
    Route::delete('/delete/{id}', [ZoneController::class, 'deleteApi']);
    Route::get('/edit/{id}', [ZoneController::class, 'editApi']);
    Route::post('/edit/{id}', [ZoneController::class, 'updateApi']);
});

Route::prefix('sub-zone')->name('sub-zone.')->group(function () {
    Route::get('/', [SubzoneController::class, 'indexApi'])->name('index');
    Route::post('/', [SubzoneController::class, 'storeApi'])->name('store');
    Route::delete('/delete/{id}', [SubzoneController::class, 'deleteApi']);
    Route::get('/edit/{id}', [SubzoneController::class, 'editApi']);
    Route::post('/edit/{id}', [SubzoneController::class, 'updateApi']);
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dash', [UserController::class, 'dash'])->name('dash');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/', [UserController::class, 'storeApi']);
    Route::get('/delete/{id}', [UserController::class, 'destroyApi']);
    Route::get('/edit/{id}', [UserController::class, 'editApi']);
    Route::post('/edit/{id}', [UserController::class, 'updateApi']);
    Route::get('/getName/{id}', [UserController::class, 'getNameApi']);
    Route::get('/all', [UserController::class, 'indexApi']);
});