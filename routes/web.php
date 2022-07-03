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
    $penjaminanMutu = \App\Models\PenjaminanMutu::all();
    $pengumuman = \App\Models\Pengumuman::paginate(5);
    return view('welcome' ,compact('pengumuman', 'penjaminanMutu'));
})->name('welcome');

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
    Route::resource('/audit', \App\Http\Controllers\AuditController::class)->except(['show']);
    Route::resource('/file-dokumen', \App\Http\Controllers\FileDokumenController::class)->only(['store', 'destroy']);
    Route::resource('/user', \App\Http\Controllers\UserController::class);
    Route::resource('/dosen', \App\Http\Controllers\DosenController::class);
    Route::resource('/berita', \App\Http\Controllers\BeritaController::class)->only('index', 'create', 'store');
});


Route::get('/test-sendmail', function () {
   $email = 'rifai0850@gmail.com';
   $password = 'apa hayo';

   dispatch(new \App\Jobs\SendEmailJob($email, $password));

   dd('done');
});
