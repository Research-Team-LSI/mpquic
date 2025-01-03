<?php

use App\Exports\AmmoniaExport;
use App\Exports\DioksidaExport;
use App\Exports\HumidityExport;
use App\Exports\MetanaExport;
use App\Exports\TemperatureExport;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MpQuicExport;
use App\Exports\HttpExport;




Route::view('/', 'welcome');
Route::get('/dashboard1', function () {
    return view('dashboard1');
})->name('dashboard1');

// Route::get('/http', function () {
//     return view('http');
// })->name('http');

// Route::get('/mpquic', function () {
//     return view('mpquic');
// })->name('mpquic');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [ChartsController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [AlatController::class, 'index'])->name('dashboard');
    Route::post('dashboard', [AlatController::class, 'store'])->name('alat.store');
    Route::get('http', [AlatController::class, 'http'])->name('http');
    Route::get('mpquic', [AlatController::class, 'mpquic'])->name('mpquic');
    Route::get('httprealtime', [AlatController::class, 'httprealtime'])->name('httprealtime');
    Route::get('mpquicrealtime', [AlatController::class, 'mpquicrealtime'])->name('mpquicrealtime');
    Route::get('/throughput-data', [AlatController::class, 'getThroughputData']);
    Route::get('/throughput-data-mpquic', [AlatController::class, 'getThroughputDatampquic']);
    Route::get('/throughput-data/{id}', [AlatController::class, 'getThroughputDatafilter'])->name('throughtputhttp');
    Route::get('/throughput-data-mpquic/{id}', [AlatController::class, 'getThroughputDatampquicfilter'])->name('throughputmpquic');
    Route::get('httpfilter/{id}', [AlatController::class, 'httpfilter'])->name('httpfilter');
    Route::get('mpquicfilter/{id}', [AlatController::class, 'mpquicfilter'])->name('mpquicfilter');
    Route::get('httpfilterrealtime/{id}', [AlatController::class, 'httpfilterrealtime'])->name('httpfilterrealtime');
    Route::get('mpquicfilterrealtime/{id}', [AlatController::class, 'mpquicfilterrealtime'])->name('mpquicfilterrealtime');


    Route::controller(RiwayatController::class)->prefix('/dashboard')->group(function () {
        Route::view('detail/1', 'dashboard/detaildashboard1')->name('detail.dashboard1');
        Route::view('detail/2', 'dashboard/detaildashboard2')->name('detail.dashboard2');
        Route::view('detail/3', 'dashboard/detaildashboard3')->name('detail.dashboard3');
        Route::view('detail/4', 'dashboard/detaildashboard4')->name('detail.dashboard4');
    });
    Route::get('chartdioksida/{id}', [ChartsController::class, 'dioksida'])->name('api.chartdioksida');
    Route::get('chartamonia/{id}', [ChartsController::class, 'amonia'])->name('api.chartamonia');
    Route::get('chartmetana/{id}', [ChartsController::class, 'metana'])->name('api.chartmetana');
    Route::get('charthumidity/{id}', [ChartsController::class, 'humidity'])->name('api.charthumidity');
    Route::get('charttemperature/{id}', [ChartsController::class, 'temperature'])->name('api.charttemperature');
    Route::view('karyawan', 'karyawan')->name('karyawan');
    Route::view('blog', 'blog')->name('blog');
    Route::view('addblog', 'addblog')->name('addblog');
    Route::view('profile', 'profile')->name('profile');

    Route::controller(RiwayatController::class)->prefix('/dashboard')->group(function () {
        Route::get('riwayat-temperature', 'riwayatTemperature')->name('riwayat.temperature');
        Route::get('riwayat-humidity', 'riwayatHumidity')->name('riwayat.humidity');
        Route::get('riwayat-metana', 'riwayatMetana')->name('riwayat.metana');
        Route::get('riwayat-dioksida', 'riwayatDioksida')->name('riwayat.dioksida');
        Route::get('riwayat-amonia', 'riwayatAmonia')->name('riwayat.amonia');

        Route::post('/data/amonia', 'getAmoniaData')->name('data.riwayatamonia');
        Route::post('/data/temperature', 'getTemperatureData')->name('data.riwayattemperature');
        Route::post('/data/metana', 'getMetanaData')->name('data.riwayatmetana');
        Route::post('/data/humidity', 'getHumidityData')->name('data.riwayathumidity');
        Route::post('/data/dioksida', 'getDioksidaData')->name('data.riwayatdioksida');
    });

    Route::get('/throughput-data', [ChartsController::class, 'getThroughputData']);




    Route::get('export/ammonia', function (Request $request) {
        $startDate = $request->query('createFrom');
        $endDate = $request->query('createTo');
        return Excel::download(new AmmoniaExport($startDate, $endDate), 'ammonia_data.xlsx');
    })->name('export.ammonia');

    Route::get('export/temperature', function (Request $request) {
        $startDate = $request->input('createFrom');
        $endDate = $request->input('createTo');

        return Excel::download(new TemperatureExport($startDate, $endDate), 'temperature_data.xlsx');
    })->name('export.temperature');

    Route::get('export/humidity', function (Request $request) {
        $startDate = $request->input('createFrom');
        $endDate = $request->input('createTo');

        return Excel::download(new HumidityExport($startDate, $endDate), 'humidity_data.xlsx');
    })->name('export.humidity');

    Route::get('export/metana', function (Request $request) {
        $startDate = $request->input('createFrom');
        $endDate = $request->input('createTo');

        return Excel::download(new MetanaExport($startDate, $endDate), 'metana_data.xlsx');
    })->name('export.metana');

    Route::get('export/dioksida', function (Request $request) {
        $startDate = $request->input('createFrom');
        $endDate = $request->input('createTo');

        return Excel::download(new DioksidaExport($startDate, $endDate), 'dioksida_data.xlsx');
    })->name('export.dioksida');

    Route::get('/export-mpquic', function () {
        return Excel::download(new MpQuicExport, 'MpQuicExport.xlsx');
    })->name('export.mpquic');

    Route::get('/export-http', function () {
        return Excel::download(new HttpExport, 'HttpExport.xlsx');
    })->name('export.http');
});

require __DIR__ . '/auth.php';
