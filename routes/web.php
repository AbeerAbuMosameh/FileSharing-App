<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

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
Route::get('/', [FileController::class, 'index'])->name('home');
Route::get('/upload-File', [FileController::class, 'upload'])->name('file.upload');
Route::post('/store-File', [FileController::class, 'store'])->name('file.store');
Route::delete('file/delete/{file}', [FileController::class, 'delete'])->name('file.destroy');
Route::get('/file/{link}/download', [FileController::class, 'download'])->name('file.download.signed');
