<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiController;
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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function() {
    return view('dashboard.index', [
        'title' => 'Dashboard'
    ]);
})->middleware('auth');

Route::resource('/dashboard/nilai', [NilaiController::class, 'index'])->middleware('auth');

// Mahasiswa
Route::get('/dashboard/feedback', [FeedbackController::class, 'index']);
Route::get('/dashboard/kritiksaran', [KritikSaranController::class, 'index']);

// Dosen
Route::get('/dashboard/jadwal', [JadwalController::class, 'index']);
// Route::get('/dashboard/jadwal/kinerja', []);
Route::get('/dashboard/kritiksarandosen', [KritikSaranController::class, 'dosen']);

// Admin
// Route::get('/dashboard/aksesedit', []);

// Superadmin
// Route::get('/dashboard/role', []);