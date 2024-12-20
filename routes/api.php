<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JurusanController;

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

Route::group(['prefix' => 'v1'], function () {

    //Jurusan
    Route::get('jurusan', [JurusanController::class, 'listJurusan']);
    Route::get('jurusan/{id}', [JurusanController::class, 'listJurusanById']);
    Route::post('jurusan/create', [JurusanController::class, 'insertJurusan']);
    Route::put('jurusan/update/{id}', [JurusanController::class, 'updateJurusan']);
    Route::delete('jurusan/delete', [JurusanController::class, 'deleteJurusan']);
});
