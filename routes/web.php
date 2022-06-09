<?php

use App\Http\Controllers\KwartirController;
use App\Models\Provinsi;
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
    $data = Provinsi::withCount(['anggota as admin' => function(Builder $q){
        $q->whereHas('user', function(Builder $q){
            $q->where('role', 'kwaran');
        });
    },
    'anggota as member' => function(Builder $q){
        $q->whereHas('user', function(Builder $q){
            $q->where('role', 'anggota');
        });
    }
    ])->orderByDesc('name')->get();

    dd($data);
    // return view('blank');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
