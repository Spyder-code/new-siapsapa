<?php
// datatable prefix

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\GudepController;
use App\Http\Controllers\KwartirController;
use App\Http\Controllers\PercetakanController;
use Illuminate\Support\Facades\Route;

Route::prefix('datatable')->group(function(){
    Route::get('percetakan', [PercetakanController::class, 'data_table'])->name('datatable.percetakan');
    Route::get('gudep', [GudepController::class, 'data_table'])->name('datatable.gudep');
    Route::get('anggota/non-active', [AnggotaController::class, 'data_table_non_active'])->name('datatable.anggota.non-active');
    Route::get('anggota/non-gudep', [AnggotaController::class, 'data_table_non_gudep'])->name('datatable.anggota.non-gudep');
    Route::get('anggota/is-gudep', [AnggotaController::class, 'data_table_is_gudep'])->name('datatable.anggota.is-gudep');
    Route::get('anggota/active', [AnggotaController::class, 'data_table_active'])->name('datatable.anggota.active');
    Route::get('anggota/non-validate', [AnggotaController::class, 'data_table_non_validate'])->name('datatable.anggota.non_validate');
    Route::get('gudep/anggota', [GudepController::class, 'data_table_anggota'])->name('datatable.gudep.anggota');
    Route::get('kwartir', [KwartirController::class, 'data_table'])->name('datatable.kwartir');
    Route::get('wrong-date', [DataController::class, 'wrong_date'])->name('datatable.data.wrong.date');
    Route::get('wrong-image', [DataController::class, 'wrong_image'])->name('datatable.data.wrong.image');
    Route::get('kwartir/anggota', [KwartirController::class, 'data_table_anggota'])->name('datatable.kwartir.anggota');
    Route::get('statistik-kwartir', [DataTableController::class, 'kwartir'])->name('datatable.kwartir.statistik');
    Route::get('juri', [DataTableController::class, 'juri'])->name('datatable.lomba.juri');
});
