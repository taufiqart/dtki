<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
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

// Route::get('/', function (){return dd(public_path('/logfile.log'));})->middleware('logactivity');
// Route::get('/tes', function(){
// 	return dd(auth()->user());
// });
Route::middleware(['logactivity'])->group(function (){
	
	// Route::get('/', function (){return geoip()->getLocation('110.137.101.138')->toArray();});
	Route::get('/', [ProfileController::class, 'departemen']);
	Route::get('/profile', function(){return Redirect::route('departemen');});

	Route::get('/profile/departemen', [ProfileController::class, 'departemen'])->name('departemen');
	Route::get('/profile/dosen', [ProfileController::class, 'dosen'])->name('dosen');
	Route::get('/profile/tendik', [ProfileController::class, 'tendik'])->name('tendik');

	Route::get('/satki', function(){return view('page.satki.login',['title' => 'SATKI','satki' => true,'profile' => true]);})->name('satki');

	Route::get('/perlombaan', [PerlombaanController::class, 'index'])->name('perlombaan');
	Route::get('/perlombaan/{perlombaan}', [PerlombaanController::class, 'show']);

	Route::get('/alumni', function(){return Redirect::route('data_alumni');});
	Route::get('/alumni/angkatan', [AlumniController::class, 'data_alumni'])->name('data_alumni');
	Route::get('/alumni/kegiatan', [AlumniController::class, 'kegiatan'])->name('alumni_kegiatan');
	Route::get('/alumni/kegiatan/{kegiatan}', [AlumniController::class, 'kegiatan_show']);

	Route::get('/penelitian', [PenelitianController::class, 'index'])->name('penelitian');
	Route::get('/penelitian/{penelitian}', [PenelitianController::class, 'show']);

	Route::get('/pengabdian-masyarakat', [PengMasyarakatController::class, 'index'])->name('peng_masyarakat');

	Route::get('/laboratorium', function(){return redirect('/laboratorium/1');});
	Route::get('/laboratorium/{lab}', [LaboratoriumController::class, 'index']);
	Route::get('/laboratorium/{lab}/{kegiatan}', [LaboratoriumController::class, 'kegiatan']);

	Route::get('/admin/login', [UserController::class, 'login'])->middleware('guest');
	Route::post('/admin/login', [UserController::class, 'authenticate']);
	Route::middleware(['auth'])->group(function (){
		Route::post('/admin/logout', [UserController::class, 'logout']);
		Route::get('/admin/setting', [UserController::class, 'setting'])->name('setting');
		Route::put('/admin/setting', [UserController::class, 'update']);
		Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');

		Route::get('/admin/profile', function(){return Redirect::route('adm_profile_departemen');});
		Route::get('/admin/profile/departemen', [AdminProfileDepartemenController::class, 'index'])->name('adm_profile_departemen');
		Route::get('/admin/profile/departemen/deskripsi', [AdminProfileDepartemenController::class, 'desIndex'])->name('adm_PD_deskripsi');
		Route::get('/admin/profile/departemen/deskripsi/edit', [AdminProfileDepartemenController::class, 'desEdit']);
		Route::put('/admin/profile/departemen/deskripsi', [AdminProfileDepartemenController::class, 'desUpdate']);
		Route::get('/admin/profile/departemen/galery', [AdminProfileDepartemenController::class, 'galeryIndex'])->name('adm_PD_galery');
		Route::get('/admin/profile/departemen/galery/create', [AdminProfileDepartemenController::class, 'galeryCreate']);
		Route::post('/admin/profile/departemen/galery', [AdminProfileDepartemenController::class, 'galeryStore']);
		Route::get('/admin/profile/departemen/galery/{galery}/edit', [AdminProfileDepartemenController::class, 'galeryEdit']);
		Route::put('/admin/profile/departemen/galery/{galery}', [AdminProfileDepartemenController::class, 'galeryUpdate']);
		Route::delete('/admin/profile/departemen/galery/{galery}', [AdminProfileDepartemenController::class, 'galeryDestroy']);
		// Route::get('/admin/profile/departemen/edit', [AdminProfileDepartemenController::class, 'edit']);
		// Route::put('/admin/profile/departemen', [AdminProfileDepartemenController::class, 'update']);

		// Route::get('/admin/profile/departemen/deskripsi', [AdminProfileDepartemenDeskripsiController::class, 'index'])->name('adm_PD_deskripsi');
		// Route::get('/admin/profile/departemen/deskripsi/edit', [AdminProfileDepartemenDeskripsiController::class, 'edit']);
		// Route::put('/admin/profile/departemen/deskripsi', [AdminProfileDepartemenDeskripsiController::class, 'update']);

		// Route::resource('/admin/profile/departemen/galery', AdminProfileDepartemenGaleryController::class, ['names'=>[
			// 'index'=>'adm_PD_galery'
		// ]]);

		Route::get('/admin/profile/dosen', [AdminProfileDosenController::class, 'index'])->name('adm_profile_dosen');
		Route::get('/admin/profile/dosen/edit', [AdminProfileDosenController::class, 'edit']);
		Route::put('/admin/profile/dosen', [AdminProfileDosenController::class, 'update']);

		Route::get('/admin/profile/tendik', [AdminProfileTendikController::class, 'index'])->name('adm_profile_tendik');
		Route::get('/admin/profile/tendik/edit', [AdminProfileTendikController::class, 'edit']);
		Route::put('/admin/profile/tendik', [AdminProfileTendikController::class, 'update']);

		Route::resource('/admin/dosen_tendik', AdminDosenTendikController::class, ['names'=>[
			// 'index'=>'adm_dosen_tendik.index'
		]])->except('show');
		Route::resource('/admin/perlombaan', AdminPerlombaanController::class)->except('show')->name('*','adm_perlombaan');
		Route::get('/admin/alumni', function(){return Redirect::route('adm_data_alumni');});
		Route::resource('/admin/alumni/data-alumni', AdminAlumniDataController::class)->except('show')->name('*','adm_data_alumni');
		Route::resource('/admin/alumni/kegiatan', AdminAlumniKegiatanController::class)->except('show')->name('*','adm_alumni_keiatan');

		Route::resource('/admin/penelitian', AdminPenelitianController::class)->except('show')->name('*','adm_penelitian');
		Route::resource('/admin/peng-masyarakat', AdminPengMasyarakatController::class)->except('show')->name('*','adm_peng_masyarakat');

		Route::get('/admin/lab/{lab}', [AdminLaboratoriumController::class, 'index']);
		Route::resource('/admin/lab/{lab}/kepala_anggota', AdminLaboratoriumKepalaAnggotaController::class)->except('show');
		Route::resource('/admin/lab/{lab}/galery', AdminLaboratoriumGaleryController::class)->except('show');
		
		Route::get('/admin/lab/{lab}/deskripsi', [AdminLaboratoriumDeskripsiController::class, 'index']);
		Route::get('/admin/lab/{lab}/deskripsi/edit', [AdminLaboratoriumDeskripsiController::class, 'edit']);
		Route::put('/admin/lab/{lab}/deskripsi', [AdminLaboratoriumDeskripsiController::class, 'update']);

		Route::get('/admin/lab/{lab}/{kegiatan_lab}', [AdminLaboratoriumKegiatanController::class,'index']);
		Route::get('/admin/lab/{lab}/{kegiatan_lab}/create', [AdminLaboratoriumKegiatanController::class,'create']);
		Route::post('/admin/lab/{lab}/{kegiatan_lab}', [AdminLaboratoriumKegiatanController::class,'store']);
		Route::get('/admin/lab/{lab}/{kegiatan_lab}/{id}/edit', [AdminLaboratoriumKegiatanController::class,'edit']);
		Route::put('/admin/lab/{lab}/{kegiatan_lab}/{id}', [AdminLaboratoriumKegiatanController::class,'update']);
		Route::delete('/admin/lab/{lab}/{kegiatan_lab}/{id}', [AdminLaboratoriumKegiatanController::class,'destroy']);

		Route::get('/admin/kontak', [AdminKontakController::class, 'index'])->name('adm_kontak');
		Route::get('/admin/kontak/edit', [AdminKontakController::class, 'edit']);
		Route::put('/admin/kontak', [AdminKontakController::class, 'update']);
	});
});
