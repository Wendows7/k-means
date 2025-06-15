<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiningController;
use App\Http\Controllers\DashboardController;




Route::get('/login', [DashboardController::class, 'login'])->name('login');
Route::post('/authenticate', [DashboardController::class, 'authenticate'])->name('login.authenticate');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('/kmeans/iteration_1', [DashboardController::class, 'iteration_1'])->name('kmeans.iteration_1');
    Route::get('/kmeans/iteration_2', [DashboardController::class, 'iteration_2'])->name('kmeans.iteration_2');
    Route::get('/kmeans/iteration_3', [DashboardController::class, 'iteration_3'])->name('kmeans.iteration_3');
    Route::get('/kmeans/iteration_final', [DashboardController::class, 'iterationFinal'])->name('kmeans.iteration_final');
    Route::post('/kmeans/iteration_final/create', [DashboardController::class, 'iterationFinalCreate'])->name('kmeans.iteration_final.create');


    Route::post('/kmeans/data/delete', [DashboardController::class, 'deleteAllData'])->name('kmeans.data.delete');
    Route::post('/kmeans/data/import', [DashboardController::class, 'importDataByExcel'])->name('kmeans.data.import');
    Route::post('/kmeans/mining', [DashboardController::class, 'mining'])->name('kmeans.mining');

    Route::get('/kmeans/profile_kelulusan', [DashboardController::class, 'profileKelulusan'])->name('kmeans.profile_kelulusan');
    Route::post('/kmeans/profile_kelulusan/create', [DashboardController::class, 'profileKelulusanCreate'])->name('kmeans.profile_kelulusan.create');
    Route::post('/kmeans/profile_kelulusan/check', [DashboardController::class, 'checkProfileKelulusan'])->name('kmeans.profile_kelulusan.check');

    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::get('/password/reset', [DashboardController::class, 'resetPassword'])->name('password.reset');
    Route::post('/password/update', [DashboardController::class, 'updatePassword'])->name('password.update');
});


