<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function (){
    Route::resource('/pengumuman', \App\Http\Controllers\PengumumanController::class);
    Route::resource('/penelitian', \App\Http\Controllers\PenelitianController::class)->except(['show']);
    Route::resource('/pengabdian', \App\Http\Controllers\PengabdianController::class)->except(['show']);
    Route::resource('/paper-ilmiah', \App\Http\Controllers\PaperIlmiahController::class)->except(['show']);
    Route::resource('/penjaminan-mutu', \App\Http\Controllers\PenjaminanMutuController::class)
        ->middleware('role:admin')
        ->except(['show']);
});
