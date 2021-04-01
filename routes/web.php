<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\PengajuanCuti;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Psr7\Message;

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

Route::group(['middleware'=>['auth']], function(){
	Route::prefix('dashboard')->group(function(){
		Route::get('/', function(){
			$data = DB::table('post')->get();
			return view('app.pages.dashboard', compact('data'));
		})->name('app.home');
		Route::get('/news/add', function(){
			return view('app.pages.pengumuman.addnews');
		})->name('app.news.add');
		Route::post('/news/add', function(Request $request){
			DB::table('post')
				->insert([
					'judul' => $request->judul,
					'desc' => $request->desc
				]);
			return redirect(route('app.home'))->with('alert','Berita sudah dipublikasikan');
		});
	});
	Route::prefix('user')->group(function(){
		Route::get('/profile/{id}', [App\Http\Controllers\UserSettingController::class,'form'])->name('app.user.profile');
		Route::patch('/profile/{id}', [App\Http\Controllers\UserSettingController::class,'update']);
	});
	Route::prefix('divisi')->group(function(){
		Route::get('/', [App\Http\Controllers\DivisiController::class,'index'])->name('app.divisi');
		Route::get('/create', [App\Http\Controllers\DivisiController::class,'create'])->name('app.divisi.create');
		Route::post('/create', [App\Http\Controllers\DivisiController::class,'save']);
		Route::get('/edit/{id}', [App\Http\Controllers\DivisiController::class,'edit'])->name('app.divisi.edit');
		Route::patch('/edit/{id}', [App\Http\Controllers\DivisiController::class,'update']);
		Route::delete('/edit/{id}', [App\Http\Controllers\DivisiController::class,'delete'])->name('app.divisi.delete');
	});
	Route::prefix('waktu')->group(function(){
		Route::get('/', [App\Http\Controllers\WaktuController::class,'index'] )->name('app.waktu');
		Route::get('/edit/{id}', [App\Http\Controllers\WaktuController::class,'edit'])->name('app.editwaktu');
		Route::patch('/edit/{id}', [App\Http\Controllers\WaktuController::class,'update']);
	});
	Route::prefix('pegawai')->group(function(){
		Route::get('/', [App\Http\Controllers\PegawaiController::class, 'index'])->name('app.pegawai');
		Route::get('/tambah', [App\Http\Controllers\PegawaiController::class, 'add'])->name('app.pegawai.create');
		Route::post('/tambah', [App\Http\Controllers\PegawaiController::class, 'save']);
		Route::get('/update/{id}', [App\Http\Controllers\PegawaiController::class, 'edit'])->name('app.pegawai.edit');
		Route::patch('/update/{id}', [App\Http\Controllers\PegawaiController::class, 'put']);
		Route::delete('/update/{id}', [App\Http\Controllers\PegawaiController::class, 'kick'])->name('app.pegawai.delete');
	});
	Route::prefix('absensi')->group(function(){
		Route::get('/', [App\Http\Controllers\AbsensiController::class, 'home'])->name('app.absensi');
		Route::post('/absen_masuk', [App\Http\Controllers\AbsensiController::class, 'checkIn'])->name('kehadiran.check-in');
		Route::post('/absen_pulang', [App\Http\Controllers\AbsensiController::class, 'checkOut'])->name('kehadiran.check-out');
		Route::get('/rekap_absensi', [App\Http\Controllers\AbsensiController::class, 'index'])->name('app.absensi.rekap');
		Route::get('/rekap_absensi/detail/{id}', [App\Http\Controllers\AbsensiController::class, 'detail'])->name('app.absensi.rekap.detail');
        Route::get('/rekap_absensi/detail/filter/{id}', [App\Http\Controllers\AbsensiController::class, 'filter'])->name('app.absensi.rekap.filter');
		});
	Route::prefix('pengajuan')->group(function(){
		Route::get('/', [App\Http\Controllers\PengajuanController::class, 'index'])->name('app.pengajuan');
		Route::get('/add', [App\Http\Controllers\PengajuanController::class, 'create'])->name('app.pengajuan.cuti.add');
		Route::post('/add', [App\Http\Controllers\PengajuanController::class, 'save']);
		Route::get('/approve/{id}', [App\Http\Controllers\PengajuanController::class, 'approve'])->name('app.pengajuan.cuti.appr');
		Route::patch('/approve/{id}', [App\Http\Controllers\PengajuanController::class, 'edit']);
	});
});

Route::get('test', function () {
	echo "route untuk melakukan unit testing aplikasi";
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

