<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GudepController;
use App\Http\Controllers\InitController;
use App\Http\Controllers\KtaController;
use App\Http\Controllers\KwartirController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\UserController;
use App\Models\Anggota;
use App\Models\DocumentType;
use App\Models\Provinsi;
use App\Repositories\StatistikService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

// Init
Route::get('init/add-to-cart', [InitController::class, 'addToCart']);


Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profile', [PageController::class, 'profile'])->name('page.profile');
Route::get('/ubah-password', [PageController::class, 'change_password'])->name('page.change_password');
Route::put('/ubah-password/{user}', [UserController::class, 'update'])->name('user.update');
Route::post('/anggota', [AnggotaController::class, 'handleUpdateOrStore'])->name('page.profile.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth','admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('data/wrong-date', [DataController::class, 'view_date'])->name('data.view.date');
        Route::put('data/wrong-date', [DataController::class, 'update_tgl_lahir'])->name('data.update.date');
        Route::get('data/wrong-image', [DataController::class, 'view_image'])->name('data.view.image');
        Route::get('statistik', [StatistikController::class, 'index'])->name('statistik.index');
        Route::post('print-kta', [CartController::class, 'print'])->name('cart.print');
        Route::resource('kwartir', KwartirController::class)->except(['show','create','store']);
        Route::resource('gudep', GudepController::class);
        Route::resource('product',ProductController::class);
        Route::resource('kta',KtaController::class);
        Route::resource('cart',CartController::class);
        Route::resource('cartproduct',CartProductController::class);
        Route::resource('anggota', AnggotaController::class)->except(['edit','show']);
        Route::put('anggota/update/status/{anggota}', [AnggotaController::class,'updateStatus'])->name('anggota.update.status');
        Route::get('anggota/non-validate', [AnggotaController::class,'non_validate'])->name('anggota.non_validate');
        Route::get('anggota/gudep/{gudep}', [GudepController::class,'anggota'])->name('gudep.anggota');
        Route::get('gudep/anggota/transfer', [GudepController::class,'transfer'])->name('gudep.transfer');
        Route::put('gudep/anggota/transfer', [GudepController::class,'transfer_store'])->name('gudep.transfer.store');
        Route::get('import/anggota', [AnggotaController::class,'import'])->name('anggota.import');
        Route::get('import/anggota/confirm', [AnggotaController::class,'import_confirm_view'])->name('anggota.import.confirm.view');
        Route::post('import/anggota/excel', [AnggotaController::class,'import_excel'])->name('anggota.import.excel');
        Route::post('import/anggota/foto', [AnggotaController::class,'import_foto'])->name('anggota.import.foto');
        Route::post('import/anggota/confirm', [AnggotaController::class,'import_confirm'])->name('anggota.import.confirm');
        Route::post('store/array', [AnggotaController::class,'store_array'])->name('anggota.store.array');
        Route::delete('import/anggota', [AnggotaController::class,'import_delete'])->name('anggota.import.delete');
        Route::get('kwartir/anggota/{id_wilayah}', [KwartirController::class, 'anggota'])->name('kwartir.anggota');
        Route::get('anggota/{anggotum}/edit', [AnggotaController::class,'edit'])->name('anggota.edit');
        Route::get('anggota/{anggotum}', [AnggotaController::class,'show'])->name('anggota.show');
        Route::resource('dokumen', DocumentController::class);
        Route::resource('agenda', AgendaController::class);
        Route::resource('user', UserController::class)->except(['update']);
    });
});

// datatable prefix
Route::prefix('datatable')->group(function(){
    Route::get('gudep', [GudepController::class, 'data_table'])->name('datatable.gudep');
    Route::get('anggota', [AnggotaController::class, 'data_table'])->name('datatable.anggota');
    Route::get('anggota/non-validate', [AnggotaController::class, 'data_table_non_validate'])->name('datatable.anggota.non_validate');
    Route::get('gudep/anggota', [GudepController::class, 'data_table_anggota'])->name('datatable.gudep.anggota');
    Route::get('kwartir', [KwartirController::class, 'data_table'])->name('datatable.kwartir');
    Route::get('wrong-date', [DataController::class, 'wrong_date'])->name('datatable.data.wrong.date');
    Route::get('wrong-image', [DataController::class, 'wrong_image'])->name('datatable.data.wrong.image');
    Route::get('kwartir/anggota', [KwartirController::class, 'data_table_anggota'])->name('datatable.kwartir.anggota');
});

Route::controller(SyncController::class)->prefix('sync')->group(function(){
    Route::get('document', 'document')->name('sync.document');
    Route::get('anggota-kta', 'anggotaKta')->name('sync.kta.anggota');
    Route::get('kta', 'kta')->name('sync.kta');
    Route::get('foto', 'foto')->name('sync.foto');
    Route::get('golongan', 'golongan')->name('sync.golongan');
});
