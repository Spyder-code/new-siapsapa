<?php

use App\Http\Controllers\Api\GudepController;
use App\Http\Controllers\Api\KwartirController;
use App\Http\Controllers\Api\StatistikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-number-of-member/{id_wilayah}', [KwartirController::class, 'getNumberOfMemberAndAdmin']);
Route::get('get-admin/{id_wilayah}', [KwartirController::class, 'getAdmin']);
Route::get('get-admin-gudep/{gudep_id}', [GudepController::class, 'getAdmin']);
Route::get('get-number-of-pramuka/{id_wilayah}', [StatistikController::class, 'getNumberOfPramuka']);
Route::get('dashboard/{id_wilayah}', [StatistikController::class, 'dashboard']);
Route::post('add-admin', [KwartirController::class, 'addAdmin']);
Route::put('delete-admin', [KwartirController::class, 'deleteAdmin']);
