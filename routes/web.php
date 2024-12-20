<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SiswaController;

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
    return view('welcome');
});

Route::get('jurusans', [JurusanController::class, 'index'])->name('jurusans.index');
Route::get('jurusans/create', [JurusanController::class, 'create'])->name('jurusans.create');
Route::post('jurusans', [JurusanController::class, 'store'])->name('jurusans.store');
Route::get('jurusans/{id}/edit', [JurusanController::class, 'edit'])->name('jurusans.edit');
Route::put('jurusans/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
Route::delete('jurusans/{id}', [JurusanController::class, 'destroy'])->name('jurusans.destroy');


Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('siswa', [SiswaController::class, 'store'])->name('siswa.store');