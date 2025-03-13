<?php

use App\Http\Controllers\AktivasiAkunController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\CparJenisPermohonanController;
use App\Http\Controllers\CparKendaraanMerekController;
use App\Http\Controllers\CparKendaraanTypeController;
use App\Http\Controllers\CparMengangkutController;
use App\Http\Controllers\CparTrayekController;
use App\Http\Controllers\DataKendaraanController;
use App\Http\Controllers\DataPermohonanController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\KartuCekController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PengajuanPermohonanController;
use App\Http\Controllers\PengaturanAkunController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\TTDDokumenController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserDataController;
use App\Models\MappingMengangkutModel;
use GuzzleHttp\Psr7\Request;
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

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('/', [LayoutController::class, 'index'])->name('auth');
//Route::get('login', [LoginController::class, 'index'])->name('login');
//Route::get('beranda', [BerandaController::class, 'index'])->middleware('auth');
Route::get('/', [LoginController::class, 'index'])->name('index');

Route::get('/panel', [PanelController::class, 'index'])->name('panel.index');

// kartu cek
Route::get('kartucek/QRcode/{id}', [KartuCekController::class, 'QRcode'])->name('kartucek.QRcode');
Route::get('kartucek/NomorKartu', [KartuCekController::class, 'NomorKartu'])->name('kartucek.NomorKartu');


Route::controller(LoginController::class)->group(function () {
    route::get('login', 'index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    route::get('register', 'index')->name('register');
    Route::post('register/do_register', 'do_register');
    route::get('register/success/{name}/{email}', 'success')->name('success');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('aktivasiAkun', [AktivasiAkunController::class, 'index'])->name('aktivasiAkun.index');
    Route::post('aktivasiAkun/store', [AktivasiAkunController::class, 'store'])->name('aktivasiAkun.store');

    // UMUM
    Route::get('pengaturanakun', [PengaturanAkunController::class, 'index'])->name('pengaturanakun.index');
    Route::put('pengaturanakun/updatepassword/{id}', [PengaturanAkunController::class, 'updatepassword'])->name('pengaturanakun.updatepassword');
    Route::put('pengaturanakun/updateemail', [PengaturanAkunController::class, 'updateemail'])->name('pengaturanakun.updateemail');



    // data user
    Route::get('dataUser/email', [PengaturanAkunController::class, 'email'])->name('dataUser.email');
    Route::get('dataUser/password', [PengaturanAkunController::class, 'index'])->name('dataUser.password');

    Route::get('dataUser/editResetPassword/{id}', [DataUserController::class, 'editResetPassword'])->name('dataUser.editResetPassword');
    Route::put('dataUser/updateResetPassword/{id}', [DataUserController::class, 'updateResetPassword'])->name('dataUser.updateResetPassword');
    Route::get('dataUser/editEmail/{id}', [DataUserController::class, 'editEmail'])->name('dataUser.editEmail');
    Route::put('dataUser/updateEmail/{id}', [DataUserController::class, 'updateEmail'])->name('dataUser.updateEmail');
    Route::get('dataUser/viewBiodata/{id}', [DataUserController::class, 'viewBiodata'])->name('dataUser.viewBiodata');


    // Jenis Permohonan
    Route::get('cparJenisPermohonan', [CparJenisPermohonanController::class, 'index'])->name('cparJenisPermohonan.index');
    Route::get('cparJenisPermohonan/show', [CparJenisPermohonanController::class, 'show'])->name('cparJenisPermohonan.show');


    // jenis permohonan
    Route::get('cparJenisPermohonan/data-tab1', [CparJenisPermohonanController::class, 'tab1Data'])->name('cparJenisPermohonan.data-tab1');
    Route::get('cparJenisPermohonan/data-tab2', [CparJenisPermohonanController::class, 'tab2Data'])->name('cparJenisPermohonan.data-tab2');
    Route::get('cparJenisPermohonan/data-tab3/{id}', [CparJenisPermohonanController::class, 'tab3Data'])->name('cparJenisPermohonan.data-tab3');




    // kendaraan
    Route::get('datakendaraan/getTypeKendaraan', [DataKendaraanController::class, 'getTypeKendaraan'])->name('datakendaraan.getTypeKendaraan');
    Route::get('datakendaraan/createUpload/{id}', [DataKendaraanController::class, 'createUpload'])->name('datakendaraan.createUpload');
    Route::get('datakendaraan/createUploadForm', [DataKendaraanController::class, 'createUploadForm'])->name('datakendaraan.createUploadForm');
    Route::get('datakendaraan/showUploadDokumenKendaraan/{id}', [DataKendaraanController::class, 'showUploadDokumenKendaraan'])->name('datakendaraan.showUploadDokumenKendaraan');

    Route::post('datakendaraan/storeUpload', [DataKendaraanController::class, 'storeUpload'])->name('datakendaraan.storeUpload');
    Route::put('datakendaraan/updateUpload/{id}', [DataKendaraanController::class, 'updateUpload'])->name('datakendaraan.updateUpload');
    Route::put('datakendaraan/destroyUploadKir/{id}', [DataKendaraanController::class, 'destroyUploadKir'])->name('datakendaraan.destroyUploadKir');
    Route::put('datakendaraan/destroyUploadSTNK/{id}', [DataKendaraanController::class, 'destroyUploadSTNK'])->name('datakendaraan.destroyUploadSTNK');



    Route::resource('datakendaraan', DataKendaraanController::class);

    // Pengajuan permohonan
    Route::get('pengajuanpermohonan/getPermohonan', [PengajuanPermohonanController::class, 'getPermohonan'])->name('pengajuanpermohonan.getPermohonan');
    Route::get('pengajuanpermohonan/getTrayek', [PengajuanPermohonanController::class, 'getTrayek'])->name('pengajuanpermohonan.getTrayek');
    Route::get('pengajuanpermohonan/getJenisAngkutan', [PengajuanPermohonanController::class, 'getJenisAngkutan'])->name('pengajuanpermohonan.getJenisAngkutan');
    Route::get('pengajuanpermohonan/getMengangkut', [PengajuanPermohonanController::class, 'getMengangkut'])->name('pengajuanpermohonan.getMengangkut');
    Route::get('pengajuanpermohonan/getPilih/{id}', [PengajuanPermohonanController::class, 'getPilih'])->name('pengajuanpermohonan.getPilih');
    Route::resource('pengajuanpermohonan', PengajuanPermohonanController::class);

    // data permohonan
    Route::get('datapermohonan/dokumenUpload/{id}', [DataPermohonanController::class, 'dokumenUpload'])->name('datapermohonan.dokumenUpload');
    Route::get('datapermohonan', [DataPermohonanController::class, 'index'])->name('datapermohonan.index');
    Route::get('datapermohonan/show', [DataPermohonanController::class, 'show'])->name('datapermohonan.show');
    Route::get('datapermohonan/detailView/{id}', [DataPermohonanController::class, 'detailView'])->name('datapermohonan.detailView');
    Route::delete('datapermohonan/destroy/{id}', [DataPermohonanController::class, 'destroy'])->name('datapermohonan.destroy');


    //admin data permohonan // ADMIN || KIR
    Route::get('datapermohonan/viewProses/{act}', [DataPermohonanController::class, 'viewProses'])->name('datapermohonan.viewProses');
    Route::get('datapermohonan/showProses', [DataPermohonanController::class, 'showProses'])->name('datapermohonan.showProses');
    Route::post('datapermohonan/validasiPermohonan/{id}', [DataPermohonanController::class, 'validasiPermohonan'])->name('datapermohonan.validasiPermohonan');
    Route::post('datapermohonan/storeTolakPermohonan/{id}', [DataPermohonanController::class, 'storeTolakPermohonan'])->name('datapermohonan.storeTolakPermohonan');
    Route::get('datapermohonan/kartuInput/{id}', [DataPermohonanController::class, 'kartuInput'])->name('datapermohonan.kartuInput');
    Route::get('datapermohonan/getModal_kartuInput/{id}', [DataPermohonanController::class, 'getModal_kartuInput'])->name('datapermohonan.getModal_kartuInput');
    Route::put('datapermohonan/storeInputKartu/{id}', [DataPermohonanController::class, 'storeInputKartu'])->name('datapermohonan.storeInputKartu');
    Route::put('datapermohonan/validasiSelesai/{id}', [DataPermohonanController::class, 'validasiSelesai'])->name('datapermohonan.validasiSelesai');
    Route::get('datapermohonan/showDataKartuPengawas/{id}', [DataPermohonanController::class, 'showDataKartuPengawas'])->name('datapermohonan.showDataKartuPengawas');
    Route::get('datapermohonan/cekAksiKartuPengawas/{id}', [DataPermohonanController::class, 'cekAksiKartuPengawas'])->name('datapermohonan.cekAksiKartuPengawas');
    Route::get('datapermohonan/createTolak/{id}', [DataPermohonanController::class, 'createTolak'])->name('datapermohonan.createTolak');
    Route::get('datapermohonan/getModalHistoriData/{id}', [DataPermohonanController::class, 'getModalHistoriData'])->name('datapermohonan.getModalHistoriData');
    Route::get('datapermohonan/getModal_kartuInputValidasi/{id}', [DataPermohonanController::class, 'getModal_kartuInputValidasi'])->name('datapermohonan.getModal_kartuInputValidasi');
    Route::delete('datapermohonan/destroyBatalProses/{id}', [DataPermohonanController::class, 'destroyBatalProses'])->name('datapermohonan.destroyBatalProses');



    // kartu pengawas
    Route::get('tools/ubahStatusKartuPengawas', [ToolsController::class, 'ubahStatusKartuPengawas'])->name('tools.ubahStatusKartuPengawas');
    Route::get('tools/showKartuPengawas', [ToolsController::class, 'showKartuPengawas'])->name('tools.showKartuPengawas');
    Route::get('tools/editKartuPengawas/{id}', [ToolsController::class, 'editKartuPengawas'])->name('tools.editKartuPengawas');
    Route::put('tools/updateKartuPengawas/{id}', [ToolsController::class, 'updateKartuPengawas'])->name('tools.updateKartuPengawas');



    // proses
    Route::get('tools/ubahStatusProses', [ToolsController::class, 'ubahStatusProses'])->name('tools.ubahStatusProses');
    Route::get('tools/showProses', [ToolsController::class, 'showProses'])->name('tools.showProses');
    Route::get('tools/editProses/{id}', [ToolsController::class, 'editProses'])->name('tools.editProses');
    Route::put('tools/updateProses/{id}', [ToolsController::class, 'updateProses'])->name('tools.updateProses');


    // laporan
    Route::get('laporan/cetakpengajuanpermohonan/{id}', [LaporanController::class, 'cetakpengajuanpermohonan'])->name('laporan.cetakpengajuanpermohonan');
    Route::get('laporan/cetakQRcode/{id}', [LaporanController::class, 'cetakQRcode'])->name('laporan.cetakQRcode');
    Route::get('laporan/cetakKartuPengawas/{id}', [LaporanController::class, 'cetakKartuPengawas'])->name('laporan.cetakKartuPengawas');
    Route::get('laporan/cetakKartuPengawasElektronik/{id}', [LaporanController::class, 'cetakKartuPengawasElektronik'])->name('laporan.cetakKartuPengawasElektronik');

    // mengangkut 
    Route::get('cparMengangkut/createMapping/{id}', [CparMengangkutController::class, 'createMapping'])->name('cparMengangkut.createMapping');
    Route::get('cparMengangkut/createMappingForm/{id}', [CparMengangkutController::class, 'createMappingForm'])->name('cparMengangkut.createMappingForm');
    Route::get('cparMengangkut/showJenisAngkutanData', [CparMengangkutController::class, 'showJenisAngkutanData'])->name('cparMengangkut.showJenisAngkutanData');
    Route::get('cparMengangkut/showJenisAngkutan', [CparMengangkutController::class, 'showJenisAngkutan'])->name('cparMengangkut.showJenisAngkutan');
    Route::post('cparMengangkut/storeMapping', [CparMengangkutController::class, 'storeMapping'])->name('cparMengangkut.storeMapping');
    Route::delete('cparMengangkut/destroyMapping/{id}', [CparMengangkutController::class, 'destroyMapping'])->name('cparMengangkut.destroyMapping');

    // upload biodata
    Route::get('upload/showUploadDokumenBiodata/{id}', [UploadController::class, 'showUploadDokumenBiodata'])->name('upload.showUploadDokumenBiodata');
    Route::get('upload/createUpload', [UploadController::class, 'createUpload'])->name('upload.createUpload');
    Route::post('upload/storeUpload', [UploadController::class, 'storeUpload'])->name('upload.storeUpload');
    Route::put('upload/updateUpload/{id}', [UploadController::class, 'updateUpload'])->name('upload.updateUpload');
    Route::delete('upload/destroy/{id}', [UploadController::class, 'destroy'])->name('upload.destroy');


    Route::group(['middleware' => ['cekUserLogin:3']], function () {
        //biodata
        Route::resource('biodata', BiodataController::class);
    });
    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        // UMUM
        Route::resource('cparKendaraanMerek', CparKendaraanMerekController::class);
        Route::resource('cparKendaraanType', CparKendaraanTypeController::class);
        Route::resource('cparTrayek', CparTrayekController::class);
        Route::resource('cparMengangkut', CparMengangkutController::class);
        Route::resource('dataUser', DataUserController::class);
        Route::resource('ttddokumen', TTDDokumenController::class);
    });
});
