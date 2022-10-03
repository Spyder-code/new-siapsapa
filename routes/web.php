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
use App\Http\Controllers\PercetakanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Anggota;
use App\Models\DocumentType;
use App\Models\Provinsi;
use App\Repositories\StatistikService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostMediaController;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

Route::get('test', function () {
    return view('social.single-blog');
});

// Init
Route::get('init/add-to-cart', [InitController::class, 'addToCart']);

// Global
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/statistik', [PageController::class, 'statistik'])->name('page.statistik');
Route::get('/i/agenda', [PageController::class, 'agenda'])->name('page.agenda');
Route::get('/i/agenda/{agenda}', [PageController::class, 'show_agenda'])->name('page.agenda.show');
Route::get('/i/agenda/{agenda}/peserta', [PageController::class, 'peserta_agenda'])->name('page.agenda.peserta');

// Social
Route::get('/anggota/{anggota_id}/feed', [SocialController::class, 'userFeed'])->name('social.userFeed');
Route::get('/anggota/{anggota_id}/sertifikat', [SocialController::class, 'userSertification'])->name('social.userSertification');
Route::get('/anggota/{anggota_id}/teman', [SocialController::class, 'userFriend'])->name('social.userFriend');
Route::get('/anggota/{anggota_id}/galeri', [SocialController::class, 'userGallery'])->name('social.userGallery');
Route::get('/berita', [SocialController::class, 'news'])->name('social.news');
Route::get('/berita/{id}', [SocialController::class, 'newsDetail'])->name('social.news.detail');
Route::get('/agenda', [SocialController::class, 'event'])->name('social.event');
Route::get('/photo', [SocialController::class, 'photo'])->name('social.photo');
Route::get('/video', [SocialController::class, 'video'])->name('social.video');
Route::get('/belanja', [SocialController::class, 'shop'])->name('social.shop');
Route::get('/penggumuman', [SocialController::class, 'announcement'])->name('social.announcement');
Route::get('/account', [SocialController::class, 'profile'])->name('social.profile');
Route::post('/post/store', [PostController::class, 'store'])->name('social.post.store');
Route::get('/agenda/{id}', [SocialController::class, 'agendaDetail'])->name('agenda.detail');
Route::post('/post/media/store', [PostMediaController::class, 'store'])->name('post.media.store');


Route::get('/profile', [PageController::class, 'profile'])->name('page.profile');
Route::get('/agenda-saya', [PageController::class, 'my_agenda'])->name('page.my_agenda');
Route::get('/dokumen-saya', [PageController::class, 'document'])->name('page.document');
Route::get('/ubah-password', [PageController::class, 'change_password'])->name('page.change_password');
Route::put('/ubah-password/{user}', [UserController::class, 'update'])->name('user.update');
Route::post('/anggota', [AnggotaController::class, 'handleUpdateOrStore'])->name('page.profile.store');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('data/wrong-date', [DataController::class, 'view_date'])->name('data.view.date');
        Route::put('data/wrong-date', [DataController::class, 'update_tgl_lahir'])->name('data.update.date');
        Route::get('data/wrong-image', [DataController::class, 'view_image'])->name('data.view.image');
        Route::get('statistik', [StatistikController::class, 'index'])->name('statistik.index');
        Route::post('print-kta/{transactionDetail}', [CartController::class, 'print'])->name('cart.print');
        Route::resource('kwartir', KwartirController::class)->except(['show', 'create', 'store']);
        Route::resource('gudep', GudepController::class);
        Route::resource('product', ProductController::class);
        Route::resource('kta', KtaController::class);
        Route::resource('cart', CartController::class);
        Route::resource('transaction', TransactionController::class);
        Route::resource('cartproduct', CartProductController::class);
        Route::resource('anggota', AnggotaController::class)->except(['edit', 'show', 'index']);
        Route::get('invoice', [TransactionController::class, 'paymentSuccess']);
        Route::post('pay/{transactionDetail}', [TransactionController::class, 'pay'])->name('transaction.pay');
        Route::get('get-anggota/{type}', [AnggotaController::class, 'index'])->name('anggota.index');
        Route::put('anggota/update/status/{anggota}', [AnggotaController::class, 'updateStatus'])->name('anggota.update.status');
        Route::get('anggota/non-validate', [AnggotaController::class, 'non_validate'])->name('anggota.non_validate');
        Route::get('anggota/gudep/{gudep}', [GudepController::class, 'anggota'])->name('gudep.anggota');
        Route::get('gudep/anggota/transfer', [GudepController::class, 'transfer'])->name('gudep.transfer');
        Route::put('gudep/anggota/transfer', [GudepController::class, 'transfer_store'])->name('gudep.transfer.store');
        Route::get('import/anggota', [AnggotaController::class, 'import'])->name('anggota.import');
        Route::get('import/anggota/confirm', [AnggotaController::class, 'import_confirm_view'])->name('anggota.import.confirm.view');
        Route::post('import/anggota/excel', [AnggotaController::class, 'import_excel'])->name('anggota.import.excel');
        Route::post('import/anggota/foto', [AnggotaController::class, 'import_foto'])->name('anggota.import.foto');
        Route::post('import/anggota/confirm', [AnggotaController::class, 'import_confirm'])->name('anggota.import.confirm');
        Route::post('store/array', [AnggotaController::class, 'store_array'])->name('anggota.store.array');
        Route::delete('import/anggota', [AnggotaController::class, 'import_delete'])->name('anggota.import.delete');
        Route::get('kwartir/anggota/{id_wilayah}', [KwartirController::class, 'anggota'])->name('kwartir.anggota');
        Route::get('anggota/{anggotum}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
        Route::get('anggota/{anggotum}', [AnggotaController::class, 'show'])->name('anggota.show');
        Route::get('user/reset-password', [UserController::class, 'reset_password'])->name('user.reset-password');
        Route::resource('dokumen', DocumentController::class);
        Route::resource('agenda', AgendaController::class);
        Route::get('agenda/{agenda}/peserta', [AgendaController::class, 'peserta'])->name('agenda.peserta');
        Route::resource('user', UserController::class)->except(['update']);
        Route::get('percetakan', [PercetakanController::class, 'index'])->name('percetakan.index');
        Route::get('percetakan/batch', [PercetakanController::class, 'batch'])->name('percetakan.batch');
        Route::post('percetakan/update/status', [PercetakanController::class, 'updateStatus'])->name('percetakan.update.status');
        Route::get('percetakan/batch/{transaction}', [PercetakanController::class, 'batchShow'])->name('percetakan.batch.show');
        Route::post('percetakan/print', [PercetakanController::class, 'print'])->name('percetakan.print');
        Route::post('percetakan/complete/{transaction}', [PercetakanController::class, 'complete'])->name('percetakan.complete');
        Route::post('transaction/complete/{transaction}', [TransactionController::class, 'complete'])->name('transaction.complete');
    });
});


Route::controller(SyncController::class)->prefix('sync')->group(function () {
    Route::get('kode', 'kodeNull')->name('sync.kode');
    Route::get('gender', 'gender')->name('sync.gender');
    Route::get('transaksi', 'transaction')->name('sync.transaction');
    Route::get('document', 'document')->name('sync.document');
    Route::get('anggota-kta', 'anggotaKta')->name('sync.kta.anggota');
    Route::get('kta', 'kta')->name('sync.kta');
    Route::get('foto', 'foto')->name('sync.foto');
    Route::get('golongan-document', 'golonganDocument')->name('sync.golongan.document');
    Route::get('golongan', 'golongan')->name('sync.golongan');
});