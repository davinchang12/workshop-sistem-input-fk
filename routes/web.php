<?php

use App\Exports\NilaiTugasExport;
use App\Http\Controllers\SettingOSCE;
use App\Http\Controllers\SettingSOCA;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SettingFieldLab;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NilaiPBLController;
use App\Http\Controllers\EditNilaiController;
use App\Http\Controllers\NilaiLainController;
use App\Http\Controllers\NilaiOSCEController;
use App\Http\Controllers\NilaiSOCAController;
use App\Http\Controllers\DosenNilaiController;
use App\Http\Controllers\InputNilaiController;
use App\Http\Controllers\NilaiTugasController;
use App\Http\Controllers\NilaiUjianController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\NilaiFieldlabController;
use App\Http\Controllers\SettingJadwalController;
use App\Http\Controllers\AdminEditNilaiController;
use App\Http\Controllers\AksesEditNilaiController;
use App\Http\Controllers\NilaiPraktikumController;
use App\Http\Controllers\NilaiTugasExportController;
use App\Http\Controllers\SettingMahasiswaMataKuliah;
use App\Http\Controllers\SettingMataKuliahController;

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

// Route::resource('/dashboard/dosen/nilai', DosenNilaiController::class)->except('show');
// Route::resource('/dashboard/nilai/edit', EditNilaiController::class)->except('show')->middleware('dosen');
// Route::resource('/dashboard/nilai/input', InputNilaiController::class)->except('show')->middleware('dosen');

Route::get('/dashboard/matkul/nilai/export/tugas', [NilaiTugasExportController::class, 'export']);
Route::post('/dashboard/matkul/nilai/import/tugas', [NilaiTugasController::class, 'import']);
Route::post('/dashboard/matkul/nilai/edit/tugas', [NilaiTugasController::class, 'check']);
Route::post('/dashboard/matkul/nilai/edit/tugas/simpan', [NilaiTugasController::class, 'simpan']);

Route::get('/dashboard/matkul/nilai/export/feedbackutb', [NilaiUjianController::class, 'export_utb']);
Route::post('/dashboard/matkul/nilai/import/feedbackutb', [NilaiUjianController::class, 'import_utb']);

Route::get('/dashboard/matkul/nilai/export/feedbackuab', [NilaiUjianController::class, 'export_uab']);
Route::post('/dashboard/matkul/nilai/import/feedbackuab', [NilaiUjianController::class, 'import_uab']);

Route::get('/dashboard/matkul/nilai/export/nilaiujian', [NilaiUjianController::class, 'export_ujian']);
Route::post('/dashboard/matkul/nilai/edit/ujian', [NilaiUjianController::class, 'check']);
Route::post('/dashboard/matkul/nilai/edit/ujian/simpan', [NilaiUjianController::class, 'simpan']);

Route::post('/dashboard/matkul/nilai/import/nilaiujian-persen', [NilaiUjianController::class, 'store']);
Route::post('/dashboard/matkul/nilai/import/nilaiujian', [NilaiUjianController::class, 'import_ujian']);

Route::post('/dashboard/matkul/nilai/input-pbl-submit', [NilaiPBLController::class, 'store']);
Route::post('/dashboard/matkul/nilai/input-pbl', [NilaiPBLController::class, 'input']);
Route::post('/dashboard/matkul/nilai/edit/pbl', [NilaiPBLController::class, 'check']);
Route::post('/dashboard/matkul/nilai/edit/pbl/simpan', [NilaiPBLController::class, 'simpan']);

Route::post('/dashboard/matkul/nilai/import/praktikum-submit', [NilaiPraktikumController::class, 'store']);
Route::get('/dashboard/matkul/nilai/import/praktikum-view', [NilaiPraktikumController::class, 'importView']);
Route::post('/dashboard/matkul/nilai/import/praktikum', [NilaiPraktikumController::class, 'import']);
Route::post('/dashboard/matkul/nilai/export/praktikum', [NilaiPraktikumController::class, 'export']);
Route::post('/dashboard/matkul/nilai/edit/praktikum', [NilaiPraktikumController::class, 'check']);
Route::post('/dashboard/matkul/nilai/edit/praktikum/simpan', [NilaiPraktikumController::class, 'simpan']);

Route::resource('/dashboard/matkul/nilai', NilaiController::class)->middleware('auth');

Route::resource('/dashboard/matkul', MatkulController::class)->only([
    'index', 'show'
])->middleware('auth');


Route::get('/dashboard/nilailain/export/field-lab', [NilaiFieldlabController::class, 'export']);
Route::post('/dashboard/nilailain/import/field-lab', [NilaiFieldlabController::class, 'import']);

Route::post('/dashboard/nilailain/input-soca-submit', [NilaiSOCAController::class, 'store']);
Route::post('/dashboard/nilailain/input-soca', [NilaiSOCAController::class, 'input']);

Route::post('/dashboard/nilailain/input-osce-submit', [NilaiOSCEController::class, 'store']);
Route::post('/dashboard/nilailain/input-osce', [NilaiOSCEController::class, 'input']);
Route::post('/dashboard/nilailain/edit/osce', [NilaiOSCEController::class, 'check']);
Route::post('/dashboard/nilailain/edit/osce/input', [NilaiOSCEController::class, 'input_edit']);
Route::post('/dashboard/nilailain/edit/osce/simpan', [NilaiOSCEController::class, 'simpan']);

Route::resource('/dashboard/nilailain', NilaiLainController::class)->middleware('auth');

Route::resource('/dashboard/kritikdansaran', KritikSaranController::class)->except('show');

// Mahasiswa
Route::get('/dashboard/feedback', [FeedbackController::class, 'index']);

// Dosen
Route::get('/dashboard/jadwal', [JadwalController::class, 'index'])->middleware('dosen');
// Route::get('/dashboard/jadwal/kinerja', []);
Route::get('/dashboard/kritiksarandosen', [KritikSaranController::class, 'dosen'])->middleware('dosen');

// Admin
Route::get('/dashboard/settingmatakuliah/trashbin', [SettingmataKuliahController::class, 'trashbin'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/force-delete', [SettingMataKuliahController::class, 'forceDelete'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/restore', [SettingMataKuliahController::class, 'restore'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/trashbin/empty-trash', [SettingMataKuliahController::class, 'emptyTrash'])->middleware('admin');

Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/trashbinpraktikum', [SettingMataKuliahController::class, 'trashbinPraktikum'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/empty-trash-praktikum', [SettingMataKuliahController::class, 'emptyPraktikum'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingpraktikum/delete', [SettingMataKuliahController::class, 'deleteJenisPraktikum'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingpraktikum/force-delete', [SettingMataKuliahController::class, 'forcedeleteJenisPraktikum'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingpraktikum/restore', [SettingMataKuliahController::class, 'restoreJenisPraktikum'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingpraktikum', [SettingMataKuliahController::class, 'storeJenisPraktikum'])->middleware('admin');
Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingpraktikum/create', [SettingMataKuliahController::class, 'createJenisPraktikum'])->middleware('admin');
Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingpraktikum', [SettingMataKuliahController::class, 'jenisPraktikum'])->middleware('admin');

Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/editdosen/create', [SettingMataKuliahController::class, 'createDosenPBL'])->middleware('admin');
Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/editdosen/trashbin', [SettingMataKuliahController::class, 'trashbinDosenPBL'])->middleware('admin');
Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/editdosen/emptytrash', [SettingMataKuliahController::class, 'createDosenPBL'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/editdosen/restore', [SettingMataKuliahController::class, 'restoreDosenPBL'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/editdosen', [SettingMataKuliahController::class, 'storeDosenPBL'])->middleware('admin');
Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/editdosen', [SettingMataKuliahController::class, 'dosenPBL'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/editdosen/delete', [SettingMataKuliahController::class, 'deleteDosenPBL'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/editdosen/force-delete', [SettingMataKuliahController::class, 'forcedeleteDosenPBL'])->middleware('admin');

Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl', [SettingMataKuliahController::class, 'kelompokPBL'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl', [SettingMataKuliahController::class, 'storeKelompokPBL'])->middleware('admin');
Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/trashbinkelompokpbl', [SettingMataKuliahController::class, 'trashbinkelompokPBL'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/emptytrash', [SettingMataKuliahController::class, 'emptykelompokPBL'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/delete', [SettingMataKuliahController::class, 'deleteKelompokPBL'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/force-delete', [SettingMataKuliahController::class, 'forcedeleteKelompokPBL'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/restore', [SettingMataKuliahController::class, 'restoredeleteKelompokPBL'])->middleware('admin');
Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingkelompokpbl/create', [SettingMataKuliahController::class, 'createKelompokPBL'])->middleware('admin');

Route::get('/dashboard/settingmatakuliah/{settingmatakuliah}/settingmahasiswamatakuliah', [SettingMataKuliahController::class, 'editMahasiswa'])->middleware('admin');
Route::post('/dashboard/settingmatakuliah/{settingmatakuliah}/settingmahasiswamatakuliah', [SettingMataKuliahController::class, 'storeEditMahasiswa'])->middleware('admin');

Route::get('/dashboard/settingjadwal/trashbin', [SettingJadwalController::class, 'trashbin'])->middleware('admin');
Route::post('/dashboard/settingjadwal/trashbin/empty-trash', [SettingJadwalController::class, 'emptyTrash'])->middleware('admin');
Route::post('/dashboard/settingjadwal/{settingjadwal}/restore', [SettingJadwalController::class, 'restore'])->middleware('admin');
Route::post('/dashboard/settingjadwal/{settingjadwal}/force-delete', [SettingJadwalController::class, 'forceDelete'])->middleware('admin');

Route::get('/dashboard/settingmatakuliah/checkBlok', [SettingMataKuliahController::class, 'checkBlok'])->middleware('admin');
Route::resource('/dashboard/settingmatakuliah', SettingMataKuliahController::class)->middleware('admin');
Route::resource('/dashboard/settingjadwal', SettingJadwalController::class)->middleware('admin');


Route::post('/dashboard/settingosce/delete', [SettingOSCE::class, 'deleteDosen'])->middleware('admin');
Route::post('/dashboard/settingosce/updatedosen', [SettingOSCE::class, 'updateDosen'])->middleware('admin');
Route::post('/dashboard/settingosce/edit', [SettingOSCE::class, 'editDosen'])->middleware('admin');
Route::post('/dashboard/settingosce/createsoal/tambah', [SettingOSCE::class, 'tambahSoal'])->middleware('admin');
Route::get('/dashboard/settingosce/createsoal/export-template', [SettingOSCE::class, 'exportTemplate'])->middleware('admin');
Route::get('/dashboard/settingosce/createsoal', [SettingOSCE::class, 'createSoal'])->middleware('admin');
Route::resource('/dashboard/settingosce', SettingOSCE::class)->middleware('admin');

Route::post('/dashboard/settingsoca/delete', [SettingSOCA::class, 'deleteDosen'])->middleware('admin');
Route::post('/dashboard/settingsoca/createsoal/tambah', [SettingSOCA::class, 'tambahSoal'])->middleware('admin');
Route::get('/dashboard/settingsoca/createsoal/export-template', [SettingSOCA::class, 'exportTemplate'])->middleware('admin');
Route::get('/dashboard/settingsoca/createsoal', [SettingSOCA::class, 'createSoal'])->middleware('admin');
Route::post('/dashboard/settingsoca/updatedosen', [SettingSOCA::class, 'updateDosen'])->middleware('admin');
Route::post('/dashboard/settingsoca/edit', [SettingSOCA::class, 'editDosen'])->middleware('admin');
Route::resource('/dashboard/settingsoca', SettingSOCA::class)->middleware('admin');

Route::post('/dashboard/settingfieldlab/deletesemester', [SettingFieldLab::class, 'deleteSemester'])->middleware('admin');
Route::post('/dashboard/settingfieldlab/deletekelompok', [SettingFieldLab::class, 'deleteKelompok'])->middleware('admin');
Route::get('/dashboard/settingfieldlab/show', [SettingFieldLab::class, 'showSemester'])->middleware('admin');
Route::resource('/dashboard/settingfieldlab', SettingFieldLab::class)->middleware('admin');

Route::resource('/dashboard/akseseditnilai', AksesEditNilaiController::class)->middleware('admin');

// Superadmin
// Route::get('/dashboard/role', [])->middleware('superadmin');


// //template
// 