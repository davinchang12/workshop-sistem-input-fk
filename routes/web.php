<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\EditNilaiController;
use App\Http\Controllers\DosenNilaiController;
use App\Http\Controllers\InputNilaiController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\AdminEditNilaiController;

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

Route::resource('/dashboard/superadmin', SuperAdminController::class)->except('show');
Route::resource('/dashboard/jadwalkinerja', JadwalController::class)->except('show');
Route::resource('/dashboard/admin/nilai/edit', AdminEditNilaiController::class)->except('show');
Route::resource('/dashboard/dosen/nilai', DosenNilaiController::class)->except('show');
Route::resource('/dashboard/nilai/edit', EditNilaiController::class)->except('show')->middleware('dosen');
Route::resource('/dashboard/nilai/input', InputNilaiController::class)->except('show')->middleware('dosen');
Route::resource('/dashboard/nilai', NilaiController::class)->middleware('auth');

Route::resource('/dashboard/kritikdansaran', KritikSaranController::class)->except('show');

// Mahasiswa
Route::get('/dashboard/feedback', [FeedbackController::class, 'index']);

// Dosen
Route::get('/dashboard/jadwal', [JadwalController::class, 'index'])->middleware('dosen');
// Route::get('/dashboard/jadwal/kinerja', []);
Route::get('/dashboard/kritiksarandosen', [KritikSaranController::class, 'dosen'])->middleware('dosen');

// Admin
// Route::get('/dashboard/akses', [])->middleware('admin');

// Superadmin
// Route::get('/dashboard/role', [])->middleware('superadmin');

