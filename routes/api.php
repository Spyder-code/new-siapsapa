<?php

use App\Http\Controllers\Api\KwartirController;
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

Route::get('get-number-of-member/{id_wilayah}', [KwartirController::class, 'numberOfMemberAndAdmin']);
Route::get('get-admin/{id_wilayah}', [KwartirController::class, 'anggotaAdmin']);
