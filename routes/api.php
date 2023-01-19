<?php

use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\AnggotaController;
use App\Http\Controllers\Api\AuthApi;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\GudepController;
use App\Http\Controllers\Api\KwartirController;
use App\Http\Controllers\Api\ReactController;
use App\Http\Controllers\Api\StatistikController;
use App\Http\Controllers\Api\TransactionController as ApiTransactionController;
use App\Http\Controllers\Api\WilayahController;
use App\Http\Controllers\TransactionController;
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

// cart
Route::post('get-number-of-cart', [CartController::class, 'numberOfCart']);
Route::get('cart/{id}', [CartController::class, 'getCartByUserId']);
Route::post('/cart', [CartController::class,'store']);
Route::delete('/cart/delete/{id}', [CartController::class,'destroy']);


// statistik
Route::get('dashboard/{id_wilayah}', [StatistikController::class, 'dashboard']);
Route::get('get-number-of-pramuka/{id_wilayah}', [StatistikController::class, 'getNumberOfPramuka']);
Route::get('get-number-of-pramuka-gudep/{gudep}', [StatistikController::class, 'getNumberOfPramukaGudep']);
Route::get('get-number-of-member/{id_wilayah}', [StatistikController::class, 'getNumberOfMemberAndAdmin']);
Route::get('get-number-of-gender/{id_wilayah}', [StatistikController::class, 'getGender']);
Route::get('get-statistik-anggota/{id_wilayah}', [StatistikController::class, 'statistikAnggota']);
Route::get('get-jumlah-anggota/{id_wilayah}', [StatistikController::class, 'jumlahAnggota']);
Route::get('get-statistik-darah/{id_wilayah}', [StatistikController::class, 'statistikDarah']);
Route::get('get-statistik-agama/{id_wilayah}', [StatistikController::class, 'statistikAgama']);
Route::get('get-statistik-tingkat/{id_wilayah}', [StatistikController::class, 'statistikTingkat']);
Route::get('get-table-anggota-muda', [StatistikController::class, 'anggotaMuda']);
Route::get('get-table-anggota-saka', [StatistikController::class, 'anggotaSaka']);
Route::get('get-table-fungsionaris', [StatistikController::class, 'fungsionaris']);

// gudep
Route::get('get-admin-gudep/{gudep_id}', [GudepController::class, 'getAdmin']);
Route::get('get-gudep/{gudep_id}', [GudepController::class, 'getGudep']);
Route::post('add-admin-gudep', [GudepController::class, 'addAdmin']);
Route::post('search-gudep', [GudepController::class, 'search']);

// kwartir
Route::get('get-admin/{id_wilayah}', [KwartirController::class, 'getAdmin']);
Route::post('add-admin', [KwartirController::class, 'addAdmin']);
Route::put('delete-admin', [KwartirController::class, 'deleteAdmin']);
Route::delete('delete-gudep', [GudepController::class, 'deleteGudep']);

// wilayah
Route::get('get-kabupaten/{id}', [WilayahController::class, 'getKabupatenByIdProvinsi']);
Route::get('get-kecamatan/{id}', [WilayahController::class, 'getKecamatanByIdKabupaten']);
Route::get('get-gudep-wilayah/{id}', [WilayahController::class, 'getGudepByIdKecamatan']);

// anggota
Route::put('anggota-validate', [AnggotaController::class, 'anggotaValidate']);
Route::put('anggota-reject', [AnggotaController::class, 'anggotaReject']);
Route::delete('anggota-delete', [AnggotaController::class, 'deleteAnggota']);
Route::get('anggota/{id}', [AnggotaController::class, 'getAnggotaById']);
Route::post('anggota/search', [AnggotaController::class, 'getAnggotaByNik']);
Route::get('admin/anggota/{id}', [AnggotaController::class, 'getAnggotaByAdminLogin']);

// document
Route::get('get-document/{id}', [DocumentController::class, 'getDocumentTypeByPramukaId']);
Route::get('get-golongan', [DocumentController::class, 'getPramuka']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('document', [DocumentController::class, 'getDocumentByUserId']);
    Route::post('document', [DocumentController::class, 'store']);
});
Route::delete('delete-document', [DocumentController::class, 'deleteDocument']);

// agenda
Route::delete('delete-agenda/{agenda}', [AgendaController::class, 'destroy']);
Route::post('add-kegiatan', [AgendaController::class, 'addKegiatan']);
Route::post('add-peserta', [AgendaController::class, 'addPeserta']);
Route::post('daftar-ulang', [AgendaController::class, 'daftarUlang']);
Route::post('undur-diri', [AgendaController::class, 'cancel']);
Route::post('add-point-juri', [AgendaController::class, 'addPointJuri'])->name('agenda.juri.addPoint');
Route::delete('delete-kegiatan', [AgendaController::class, 'deleteKegiatan']);
Route::delete('delete-peserta', [AgendaController::class, 'deletePeserta']);
Route::put('update-kegiatan', [AgendaController::class, 'updateKegiatan']);
Route::post('agenda-file', [AgendaController::class, 'fileStore'])->name('agenda.fileStore');
Route::post('destroy-file', [AgendaController::class, 'fileDestroy'])->name('agenda.file.delete');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('get-agenda', [AgendaController::class, 'getAgenda']);
    Route::get('peserta-agenda/{agenda}', [AgendaController::class, 'getPesertaAgenda']);
});

// Transaction
Route::middleware('auth:sanctum')->group(function () {
    Route::get('transaction', [ApiTransactionController::class, 'index']);
    Route::get('transaction/{transactionDetail}', [ApiTransactionController::class, 'show']);
});
Route::post('transaction', [ApiTransactionController::class, 'store']);
Route::post('pay-transaction/{transactionDetail}', [ApiTransactionController::class, 'pay']);

// Auth
Route::post('register',[AuthApi::class,'register']);
Route::post('login',[AuthApi::class,'login']);
Route::post('reset-password',[AuthApi::class,'resetPassword']);

// Midtrans
Route::post('notification/handling', [TransactionController::class, 'notificationHandling']);

Route::middleware('auth:sanctum')->group(function () {
    // Route::post('logout', [AuthApi::class, 'logout']);
    // Route::get('user', [AuthApi::class, 'user']);
    // Route::post('/tokens/create', [AuthApi::class, 'createToken']);
    // Route::get('/anggota/{id}', [AnggotaController::class,'getAnggotaById']);
    // Route::get('/admin/anggota/{id}', [AnggotaController::class,'getAnggotaByAdminLogin']);
    // Route::get('/cart/{id}', [CartController::class,'getCartByUserId']);
    // Route::delete('/cart/delete/{id}', [CartController::class,'destroy']);
    // Route::post('/cart', [CartController::class,'store']);
    // Route::get('get-wilayah/{id_wilayah}', [WilayahController::class, 'getData']);
    // Route::get('get-provinsi', [WilayahController::class, 'getProvince']);
    // Route::get('get-kabupaten/{id}', [WilayahController::class, 'getKabupatenByIdProvinsi']);
    // Route::get('get-kecamatan/{id}', [WilayahController::class, 'getKecamatanByIdKabupaten']);
});

Route::post('comment', [CommentController::class,'store'])->name('api.comment.store');
Route::post('react', [ReactController::class,'store'])->name('api.react.store');

// Raja Ongkir
Route::get('ongkir/provinsi', [WilayahController::class,'getProvinceOngkir'])->name('api.ongkir.province');
Route::get('ongkir/kota', [WilayahController::class,'getCityOngkir'])->name('api.ongkir.city');
Route::post('ongkir', [WilayahController::class,'getOngkir'])->name('api.ongkir');
