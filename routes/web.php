<?php

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
    $str = '11.20.00.000.740765';
    $data = substr_replace($str, '22', 6, 2);
    return $data;
    return view('blank');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');

// Kwartir
// Route::get('kwartir', [KwartirController::class, 'index'])->name('kwartir.index');
// Route::get('kwartir/{id_wilayah}/edit', [KwartirController::class, 'edit'])->name('kwartir.edit');
Route::resource('kwartir', KwartirController::class)->except(['show','create','store']);
Route::get('kwartir/anggota/{id_wilayah}', [KwartirController::class, 'anggota'])->name('kwartir.anggota');

// datatable prefix
Route::prefix('datatable')->group(function(){
    Route::get('kwartir', [KwartirController::class, 'data_table'])->name('datatable.kwartir');
    Route::get('kwartir/anggota', [KwartirController::class, 'data_table_anggota'])->name('datatable.kwartir.anggota');
});
