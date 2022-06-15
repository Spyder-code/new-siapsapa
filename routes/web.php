<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\GudepController;
use App\Http\Controllers\KwartirController;
use App\Http\Controllers\StatistikController;
use App\Models\Anggota;
use App\Models\DocumentType;
use App\Models\Provinsi;
use App\Repositories\StatistikService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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
    $gudep = 3554;
    $statistik = new StatistikService(5101);
    $data = $statistik->getNumberOfMemberAndAdmin($gudep);
    return view('blank');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');

// Kwartir
// Route::get('kwartir', [KwartirController::class, 'index'])->name('kwartir.index');
// Route::get('kwartir/{id_wilayah}/edit', [KwartirController::class, 'edit'])->name('kwartir.edit');
Route::resource('kwartir', KwartirController::class)->except(['show','create','store']);
Route::resource('gudep', GudepController::class);
Route::resource('anggota', AnggotaController::class);
Route::get('import/anggota', [AnggotaController::class,'import'])->name('anggota.import');
Route::get('import/anggota/confirm', [AnggotaController::class,'import_confirm_view'])->name('anggota.import.confirm.view');
Route::post('import/anggota/excel', [AnggotaController::class,'import_excel'])->name('anggota.import.excel');
Route::post('import/anggota/foto', [AnggotaController::class,'import_foto'])->name('anggota.import.foto');
Route::post('import/anggota/confirm', [AnggotaController::class,'import_confirm'])->name('anggota.import.confirm');
Route::post('store/array', [AnggotaController::class,'store_array'])->name('anggota.store.array');
Route::delete('import/anggota', [AnggotaController::class,'import_delete'])->name('anggota.import.delete');
Route::get('kwartir/anggota/{id_wilayah}', [KwartirController::class, 'anggota'])->name('kwartir.anggota');

// datatable prefix
Route::prefix('datatable')->group(function(){
    Route::get('gudep', [GudepController::class, 'data_table'])->name('datatable.gudep');
    Route::get('anggota', [AnggotaController::class, 'data_table'])->name('datatable.anggota');
    Route::get('gudep/anggota', [GudepController::class, 'data_table_anggota'])->name('datatable.gudep.anggota');
    Route::get('kwartir', [KwartirController::class, 'data_table'])->name('datatable.kwartir');
    Route::get('kwartir/anggota', [KwartirController::class, 'data_table_anggota'])->name('datatable.kwartir.anggota');
});
