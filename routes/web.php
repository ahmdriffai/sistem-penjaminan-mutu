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

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/berita/detail/{id}', [\App\Http\Controllers\WelcomeController::class, 'detailBerita'])->name('detail-berita');
Route::get('/pengumuman/detail/{id}', [\App\Http\Controllers\WelcomeController::class, 'detailPengumuman'])->name('detail-pengumuman');
Route::get('/dokumen-mutu/detail/{id}', [\App\Http\Controllers\WelcomeController::class, 'dokumenMutu'])->name('welcome.dokumen-mutu');
Route::get('/detail-documen-mutu/{id}', [\App\Http\Controllers\WelcomeController::class, 'detailDokumenMutu'])->name('welcome.detail-dokumen-mutu');

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

    Route::resource('/dokumen-mutu', \App\Http\Controllers\DokumenMutuController::class);
    Route::get('/dokumen-mutu/list/show/{id}', [\App\Http\Controllers\DokumenMutuController::class, 'listShow'])->name('dokumen-mutu.list.show');
    Route::get('/dokumen-mutu/create/{id}', [\App\Http\Controllers\DokumenMutuController::class, 'createById'])->name('dokumen-mutu.create.id');
    Route::resource('/audit', \App\Http\Controllers\AuditController::class)->except(['show']);
    Route::resource('/file-dokumen', \App\Http\Controllers\FileDokumenController::class)->only(['store', 'destroy']);
    Route::resource('/user', \App\Http\Controllers\UserController::class);
    Route::resource('/dosen', \App\Http\Controllers\DosenController::class);
    Route::resource('/berita', \App\Http\Controllers\BeritaController::class);
});


Route::get('/test-sendmail', function () {
   $email = 'rifai0850@gmail.com';
   $password = 'apa hayo';

   dispatch(new \App\Jobs\SendEmailJob($email, $password));

   dd('done');
});
