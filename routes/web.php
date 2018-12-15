<?php

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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['auth', 'role:user|administrator|bendahara|pimpinan|ppk|petugas_spm']], function () {
    Route::get('/', [
        'as'   => 'dashboard',
        'uses' => 'Backend\DashboardController@index'
    ]);

    Route::get('/getPaguAnggaran', [
        'as'   => 'dashboard_pagu_anggaran',
        'uses' => 'Backend\DashboardController@get_pagu_anggaran'
    ]);

    Route::get('/getjum', [
        'as'   => 'dashboard_pagu_anggaran',
        'uses' => 'Backend\DashboardController@get_jmlalokasi'
    ]);

    Route::get('/getjenisbelanja', [
        'as'   => 'dash_jenis_belanja',
        'uses' => 'Backend\DashboardController@get_jenis_belanja'
    ]);

    Route::get('/getjenisbelanjaeselondua/{id}', [
        'as'   => 'dash_jenis_belanja',
        'uses' => 'Backend\DashboardController@get_jenis_belanja_eselon_dua'
    ]);

    Route::get('/getrpdsummary', [
        'as'   => 'dash_rpdsummary',
        'uses' => 'Backend\DashboardController@get_rpd_summary'
    ]);

    Route::get('/getrpdsummaryeselondua/{id}', [
        'as'   => 'dash_rpdsummary',
        'uses' => 'Backend\DashboardController@get_rpd_summary_eselon_dua'
    ]);

    Route::get('/get_pengadaaneselondua/{id}', [
        'as'   => 'dash_jenis_belanja',
        'uses' => 'Backend\DashboardController@realisasi_pengadaan_eselon_dua'
    ]);

    Route::get('/get_pengadaanoblik', [
        'as'   => 'dash_jenis_belanja',
        'uses' => 'Backend\DashboardController@realisasi_pengadaan_oblik'
    ]);

    Route::get('/get_pengadaanyanfar', [
        'as'   => 'dash_jenis_belanja',
        'uses' => 'Backend\DashboardController@realisasi_pengadaan_yanfar'
    ]);

    Route::get('/get_pengadaanfm', [
        'as'   => 'dash_jenis_belanja',
        'uses' => 'Backend\DashboardController@realisasi_pengadaan_fm'
    ]);

    Route::get('/get_pengadaanpenalkes', [
        'as'   => 'dash_jenis_belanja',
        'uses' => 'Backend\DashboardController@realisasi_pengadaan_penalkes'
    ]);

    Route::get('/get_pengadaanwasalkes', [
        'as'   => 'dash_jenis_belanja',
        'uses' => 'Backend\DashboardController@realisasi_pengadaan_wasalkes'
    ]);

    Route::get('/getmatrix', [
        'as'   => 'dash_matrix',
        'uses' => 'Backend\DashboardController@get_matrix'
    ]);

    Route::get('/getpie', [
        'as'   => 'dash_pie',
        'uses' => 'Backend\DashboardController@get_pie_realisasi'
    ]);

    Route::get('/get_pie_realisasi_eselon_dua/{id}', [
        'as'   => 'dash_pie',
        'uses' => 'Backend\DashboardController@get_pie_realisasi_eselon_dua'
    ]);

    Route::get('/get_pnbp', [
        'as'   => 'dash_pnbp',
        'uses' => 'Backend\DashboardController@realisasi_pnbp'
    ]);

    // Route::get('/get_jumpnbp', [
    //     'as'   => 'dash_pnbp',
    //     'uses' => 'Backend\DashboardController@jum_realisasi_pnbp'
    // ]);

    Route::get('/realisasi_pnbp_eselon_dua/{id}', [
        'as'   => 'dash_pnbp',
        'uses' => 'Backend\DashboardController@realisasi_pnbp_eselon_dua'
    ]);


    Route::get('/get_tupoksi', [
        'as'   => 'dash_tupoksi',
        'uses' => 'Backend\DashboardController@realisasi_tupoksi'
    ]);

    Route::get('/get_tupoksi_eselon_dua/{id}', [
        'as'   => 'dash_tupoksi',
        'uses' => 'Backend\DashboardController@realisasi_tupoksi_eselon_dua'
    ]);

    Route::get('/get_pengadaan', [
        'as'   => 'dash_tupoksi',
        'uses' => 'Backend\DashboardController@realisasi_pengadaan'
    ]);

    Route::get('/get_spm/{id}', [
        'as'   => 'dash_tupoksi',
        'uses' => 'Backend\DashboardController@get_spm_sp2d'
    ]);

    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::resource('hotel', 'Backend\Master\HotelController');
        Route::post('hotel/store', 'Backend\Master\HotelController@store')->name('hotel.store');
        Route::post('hotel', 'Backend\Master\HotelController@search')->name('hotel.search');
    });
});

Route::group(['middleware' => ['auth', 'role:user|bendahara|pimpinan|ppk|administrator']], function () {
    Route::group(['prefix' => 'pengajuan', 'as' => 'pengajuan.'], function () {
        Route::resource('kegiatan', 'Backend\Pengajuan\KegiatanController');
        Route::group(['prefix' => 'kegiatan', 'as' => 'kegiatan.'], function () {
            Route::post('store', 'Backend\Pengajuan\KegiatanController@store')->name('store');
            Route::post('/', 'Backend\Pengajuan\KegiatanController@search')->name('search');
            Route::any('memuat-mak/{judul?}', 'Backend\Pengajuan\KegiatanController@memuatMak')->name('memuat-mak');
            Route::any('memuat-uraian/{id?}', 'Backend\Pengajuan\KegiatanController@memuatUraian')->name('memuat-uraian');
            Route::get('{id}/nota-dinas', 'Backend\Pengajuan\KegiatanController@notaDinas')->name('nota-dinas');
            Route::get('{id}/surat-tugas', 'Backend\Pengajuan\KegiatanController@surat_tugas')->name('surat-tugas');

            Route::get('detail-akun/{id}', 'Backend\Pengajuan\DetailAkunController@detailAkun')->name('detail-akun');
            Route::delete('detail-akun/{id}/destroy', 'Backend\Pengajuan\DetailAkunController@destroy')->name('detail-akun.destroy');
            Route::post('detail-akun/{id}', 'Backend\Pengajuan\DetailAkunController@search')->name('detail-akun.search');

            Route::get('detail-akun/{id}/list-akun', 'Backend\Pengajuan\PilihAkunController@listAkun')->name('detail-akun.list-akun');
            Route::post('detail-akun/{id}/list-akun/store', 'Backend\Pengajuan\DetailKegiatanController@store')->name('detail-akun.list-akun.store');

            Route::get('list-pegawai/{id}', 'Backend\Pengajuan\PegawaiController@listPegawai')->name('list-pegawai');
            Route::post('pilih-pegawai/{id}', 'Backend\Pengajuan\PegawaiController@pilihPegawai')->name('pilih-pegawai');

            Route::get('draft-kegiatan/{id}', 'Backend\Pengajuan\KegiatanController@draftKegiatan')->name('draft-kegiatan');
            Route::delete('draft-kegiatan/{kegiatan_id}pegawai/destroy/{id}', 'Backend\Pengajuan\PegawaiController@destroy')->name('draft-kegiatan.pegawai.destroy');

            Route::get('draft-kegiatan/{id}/kuitansi-pembayaran', 'Backend\Pengajuan\KegiatanController@kuitansipembayaranlangsung')->name('draft-kegiatan.kuitansi-pembayaran');
            Route::get('draft-kegiatan/{id}/kuitansi-pembayaran-up', 'Backend\Pengajuan\KegiatanController@kuitansipembayaranlangsungUP')->name('draft-kegiatan.kuitansi-pembayaran-up');
            Route::get('draft-kegiatan/{id}/selesai', 'Backend\Pengajuan\KegiatanController@selesai_pengajuan')->name('draft-kegiatan.selesai_pengajuan');

            Route::get('nominatif/{id}', 'Backend\Pengajuan\NominatifController@index')->name('nominatif.index');
            Route::get('{kegiatan_id}/nominatif-fullday', 'Backend\Pengajuan\NominatifController@downloadNominatifFullday')->name('nominatif.nominatif-fullday');
            Route::get('{kegiatan_id}/nominatif-fullboard', 'Backend\Pengajuan\NominatifController@downloadNominatifFullboard')->name('nominatif.nominatif-fullboard');
            Route::get('nominatif/{id}/kuitansi-rill', 'Backend\Pengajuan\NominatifController@cetakRill')->name('nominatif.kuitansi-rill');
            //Route::post('nominatif/import-perjadin/{id}', 'Backend\Pengajuan\NominatifController@importPerjadin')->name('nominatif.import-perjadin');
            Route::post('nominatif/importPusat/{id}', 'Backend\Pengajuan\NominatifController@importPusat')->name('nominatif.importPusat');
            Route::post('nominatif/importLokal/{id}', 'Backend\Pengajuan\NominatifController@importLokal')->name('nominatif.importLokal');
            Route::post('nominatif/importPusatfb/{id}', 'Backend\Pengajuan\NominatifController@importPusatfb')->name('nominatif.importPusatfb');
            Route::post('nominatif/importDaerahfb/{id}', 'Backend\Pengajuan\NominatifController@importDaerahfb')->name('nominatif.importDaerahfb');
            Route::delete('nominatif/destroy/{id}', 'Backend\Pengajuan\NominatifController@destroy')->name('nominatif.destroy');
            //Route::delete('nominatif/deletePerjadin/{id}', 'Backend\Pengajuan\NominatifController@deletePerjadin')->name('nominatif.deletePerjadin');
            Route::delete('nominatif/fulldayLocal/{id}', 'Backend\Pengajuan\NominatifController@fulldayLocal')->name('nominatif.fulldayLocal');
            Route::delete('nominatif/fulldayPusat/{id}', 'Backend\Pengajuan\NominatifController@fulldayPusat')->name('nominatif.fulldayPusat');
            Route::delete('nominatif/nominatifDaerah/{id}', 'Backend\Pengajuan\NominatifController@nominatifDaerah')->name('nominatif.nominatifDaerah');
            Route::delete('nominatif/nominatifPusat/{id}', 'Backend\Pengajuan\NominatifController@nominatifPusat')->name('nominatif.nominatifPusat');
        });

        Route::resource('layanan-perkantoran', 'Backend\Pengajuan\LayananPerkantoran\PerkantoranController');
        Route::group(['prefix' => 'layanan-perkantoran', 'as' => 'layanan-perkantoran.'], function () {
            Route::post('store', 'Backend\Pengajuan\LayananPerkantoran\PerkantoranController@store')->name('store');
            Route::post('/', 'Backend\Pengajuan\LayananPerkantoran\PerkantoranController@search')->name('search');

            Route::get('{id}/detail-perkantoran', 'Backend\Pengajuan\LayananPerkantoran\DetailPerkantoranController@detailPerkantoran')->name('detail-perkantoran');
            Route::post('{perkantoran_id}/detail-perkantoran/store', 'Backend\Pengajuan\LayananPerkantoran\DetailPerkantoranController@store')->name('detail-perkantoran.store');
            Route::get('{id}/nota-dinas', 'Backend\Pengajuan\LayananPerkantoran\PerkantoranController@notaDinas')->name('nota-dinas');

            Route::get('{id}/dokumen', 'Backend\Pengajuan\LayananPerkantoran\DokumenPerkantoranController@index')->name('dokumen');
            Route::post('{perkantoran_id}/dokumen/store', 'Backend\Pengajuan\LayananPerkantoran\DokumenPerkantoranController@store')->name('dokumen.store');
            Route::delete('{perkantoran_id}/dokumen/{id}/destroy', 'Backend\Pengajuan\LayananPerkantoran\DokumenPerkantoranController@destroy')->name('dokumen.destroy');
            Route::post('{id}/dokumen', 'Backend\Pengajuan\LayananPerkantoran\DokumenPerkantoranController@search')->name('dokumen.search');

            Route::get('{id}/draft-perkantoran', 'Backend\Pengajuan\LayananPerkantoran\PerkantoranController@draftPerkantoran')->name('draft-perkantoran');
            Route::get('{id}/kirim-layanan-perkantoran', 'Backend\Pengajuan\LayananPerkantoran\PerkantoranController@kirimPerkantoran')->name('kirim-layanan-perkantoran');
            Route::any('memuat-uraian/{id?}', 'Backend\Pengajuan\LayananPerkantoran\PerkantoranController@memuatUraian')->name('memuat-uraian');
        });

        Route::resource('perjadin-dalam-negeri', 'Backend\Pengajuan\Perjadin\PerjadinController');
        Route::group(['prefix' => 'perjadin-dalam-negeri', 'as' => 'perjadin-dalam-negeri.'], function () {
            Route::post('/', 'Backend\Pengajuan\Perjadin\PerjadinController@search')->name('search');
            Route::get('{id}/nota-dinas', 'Backend\Pengajuan\Perjadin\PerjadinController@notaDinas')->name('nota-dinas');
            Route::post('store', 'Backend\Pengajuan\Perjadin\PerjadinController@store')->name('store');
            Route::any('memuat-mak/{judul?}', 'Backend\Pengajuan\Perjadin\PerjadinController@memuatMak')->name('memuat-mak');
            Route::any('memuat-uraian/{no_mak?}', 'Backend\Pengajuan\Perjadin\PerjadinController@memuatUraian')->name('memuat-uraian');
            Route::any('memuat-kabkota/{id?}', 'Backend\Pengajuan\Perjadin\PerjadinController@memuatKabkota')->name('memuat-kabkota');
            Route::any('memuat-nip/{id?}', 'Backend\Pengajuan\Perjadin\DetailPerjadinController@memuatNip')->name('memuat-nip');
            Route::any('memuat-nip-tamu/{id?}', 'Backend\Pengajuan\Perjadin\DetailPerjadinController@memuatNiptamu')->name('memuat-nip-tamu');

            Route::get('{id}/detail-akun', 'Backend\Pengajuan\Perjadin\PerjadinAkunController@perjadinAkun')->name('detail-akun');
            Route::delete('detail-akun/{id}/destroy', 'Backend\Pengajuan\Perjadin\PerjadinAkunController@destroy')->name('detail-akun.destroy');
            Route::post('{id}/detail-akun', 'Backend\Pengajuan\Perjadin\PerjadinAkunController@search')->name('detail-akun.search');

            Route::get('{id}/detail-akun/list-akun', 'Backend\Pengajuan\Perjadin\PilihAkunController@listAkun')->name('detail-akun.list-akun');
            Route::post('{id}/detail-akun/list-akun/store', 'Backend\Pengajuan\Perjadin\PilihAkunController@store')->name('detail-akun.list-akun.store');

            Route::get('{id}/detail-pelaksana', 'Backend\Pengajuan\Perjadin\DetailPerjadinController@listPelaksana')->name('detail-pelaksana');
            Route::post('{id}/detail-pelaksana/store', 'Backend\Pengajuan\Perjadin\DetailPerjadinController@store')->name('detail-pelaksana.store');
            Route::post('{id}/detail-pelaksana/store_tamu', 'Backend\Pengajuan\Perjadin\DetailPerjadinController@store_tamu')->name('detail-pelaksana.store_tamu');
            Route::delete('{id}/detail-pelaksana/destroy', 'Backend\Pengajuan\Perjadin\DetailPerjadinController@destroy')->name('detail-pelaksana.destroy');
            Route::post('{id}/detail-pelaksana', 'Backend\Pengajuan\Perjadin\DetailPerjadinController@search')->name('detail-pelaksana.search');

            Route::get('{id}/list-pegawai', 'Backend\Pengajuan\Perjadin\PegawaiController@listPegawai')->name('list-pegawai');
            Route::post('{id}/pilih-pegawai', 'Backend\Pengajuan\Perjadin\PegawaiController@pilihPegawai')->name('pilih-pegawai');

            Route::delete('draft-perjadin/{perjadin_id}/pegawai/destroy/{id}', 'Backend\Pengajuan\Perjadin\PegawaiController@destroy')->name('draft-perjadin.pegawai.destroy');

            Route::get('{id}/draft-perjadin', 'Backend\Pengajuan\Perjadin\PerjadinController@draftPerjadin')->name('draft-perjadin');
            Route::get('{id}/draft-perjadin/kirim-perjadin', 'Backend\Pengajuan\Perjadin\PerjadinController@kirimPerjadin')->name('draft-perjadin.kirim-perjadin');
        });

        Route::resource('perjadin-luar-negeri', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController');
        Route::group(['prefix' => 'perjadin-luar-negeri', 'as' => 'perjadin-luar-negeri.'], function () {
            Route::post('/', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@search')->name('search');
            Route::get('{id}/nota-dinas', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@notaDinas')->name('nota-dinas');
            Route::post('store', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@store')->name('store');
            Route::any('memuat-mak/{judul?}', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@memuatMak')->name('memuat-mak');
            Route::any('memuat-uraian/{no_mak?}', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@memuatUraian')->name('memuat-uraian');
            Route::any('memuat-kabkota/{id?}', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@memuatKabkota')->name('memuat-kabkota');
            
            Route::get('{id}/detail-akun', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriAkunController@perjadinAkun')->name('detail-akun');
            Route::delete('detail-akun/{id}/destroy', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriAkunController@destroy')->name('detail-akun.destroy');
            Route::post('{id}/detail-akun', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriAkunController@search')->name('detail-akun.search');

            Route::get('{id}/detail-akun/list-akun', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPilihAkunController@listAkun')->name('detail-akun.list-akun');
            Route::post('{id}/detail-akun/list-akun/store', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPilihAkunController@store')->name('detail-akun.list-akun.store');

            Route::get('{id}/detail-pelaksana', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPelaksanaController@listPelaksana')->name('detail-pelaksana');
            Route::post('{id}/detail-pelaksana/store', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPelaksanaController@store')->name('detail-pelaksana.store');
            Route::delete('{id}/detail-pelaksana/destroy', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPelaksanaController@destroy')->name('detail-pelaksana.destroy');
            Route::post('{id}/detail-pelaksana', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPelaksanaController@search')->name('detail-pelaksana.search');
            Route::any('memuat-nip/{id?}', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPelaksanaController@memuatNip')->name('memuat-nip');

            Route::get('{id}/list-pegawai', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPegawaiController@listPegawai')->name('list-pegawai');
            Route::post('{id}/pilih-pegawai', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPegawaiController@pilihPegawai')->name('pilih-pegawai');
            Route::delete('draft-perjadin/{perjadin_id}/pegawai/destroy/{id}', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPegawaiController@destroy')->name('draft-perjadin.pegawai.destroy');

            Route::get('{id}/draft-perjadin', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@draftPerjadin')->name('draft-perjadin');
            Route::get('{id}/draft-perjadin/kirim-perjadin', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@kirimPerjadin')->name('draft-perjadin.kirim-perjadin');
            Route::get('memuatPegawai/{eselonid?}' , 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPelaksanaController@memuatPegawai')->name('memuat-pegawai');
            Route::get('memuatkelasbiaya/{idkelas?}/{idnegara?}' , 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriPelaksanaController@memuatkelasbiaya')->name('memuat-kelas-biaya');
        });

        Route::group(['prefix' => 'upload' , 'as' => 'upload.'] , function(){
            Route::get('/upload_pengajuan' , 'Backend\Pengajuan\UploadController@index')->name('index');
            Route::post('/upload_rkakl_temp' , 'Backend\Pengajuan\UploadController@upload')->name('rkakl-temp');
            Route::get('/generate_transaksi' , 'Backend\Pengajuan\UploadController@generate')->name('generate-transaksi');
        });
    });

    Route::group(['prefix' => 'pertanggungjawaban', 'as' => 'pertanggungjawaban.'], function () {
        Route::resource('kegiatan', 'Backend\Pertanggungjawaban\pj_kegiatanController');
        Route::group(['prefix' => 'kegiatan', 'as' => 'kegiatan.'], function () {
            Route::get('{id}/detail-kegiatan', 'Backend\Pertanggungjawaban\pj_kegiatanController@show')->name('detail');
            Route::post('/', 'Backend\Pertanggungjawaban\pj_kegiatanController@search')->name('search');
            Route::post('detail/{id}', 'Backend\Pertanggungjawaban\pj_kegiatanController@pj_detail')->name('pj_detail');

            Route::post('import', 'Backend\Pertanggungjawaban\pj_kegiatanController@import')->name('import');
            Route::post('import-fullday', 'Backend\Pertanggungjawaban\pj_kegiatanController@importfb')->name('import-fullday');
            Route::delete('hapus_nominatif/{id}', 'Backend\Pertanggungjawaban\pj_kegiatanController@destroy_nominatif')->name('hapus_nominatif');
            Route::post('destroy_nominatif', 'Backend\Pertanggungjawaban\pj_kegiatanController@destroy')->name('destroy_nominatif');
        });

        Route::resource('perjadin-dalam-negeri', 'Backend\Pertanggungjawaban\Pj_PerjadinController');
        Route::group(['prefix' => 'perjadin-dalam-negeri', 'as' => 'perjadin-dalam-negeri.'], function () {
            Route::post('/', 'Backend\Pertanggungjawaban\Pj_PerjadinController@search')->name('search');
            Route::get('{id}/detail-perjadin', 'Backend\Pertanggungjawaban\Pj_PerjadinController@pj_detail')->name('pj_detail');
            Route::get('{id}/draft-perjadin', 'Backend\Pertanggungjawaban\Pj_PerjadinController@pj_draft')->name('pj_draf');
            Route::post('{id}/kirim', 'Backend\Pertanggungjawaban\Pj_PerjadinController@kirim')->name('kirim');
            Route::get('{id}/draft-perjadin/kuitansi-rill', 'Backend\Pertanggungjawaban\Pj_PerjadinController@kuitansiRill')->name('draft-perjadin.kuitansi-rill');
        });

        Route::resource('perjadin-luar-negeri', 'Backend\Pertanggungjawaban\Pj_PerjadinLuarNegriController');
        Route::group(['prefix' => 'perjadin-luar-negeri', 'as' => 'perjadin-luar-negeri.'], function () {
            Route::post('/', 'Backend\Pertanggungjawaban\Pj_PerjadinLuarNegriController@search')->name('search');
            Route::get('{id}/detail-perjadin', 'Backend\Pertanggungjawaban\Pj_PerjadinLuarNegriController@pj_detail')->name('pj_detail');
            Route::get('{id}/draft-perjadin', 'Backend\Pertanggungjawaban\Pj_PerjadinLuarNegriController@pj_draft')->name('pj_draf');
            Route::post('{id}/kirim', 'Backend\Pertanggungjawaban\Pj_PerjadinLuarNegriController@kirim')->name('kirim');
            Route::get('{id}/draft-perjadin/kuitansi-rill', 'Backend\Pertanggungjawaban\Pj_PerjadinLuarNegriController@kuitansiRill')->name('draft-perjadin.kuitansi-rill');
        });

        Route::resource('layanan-perkantoran', 'Backend\Pertanggungjawaban\Pj_PerkantoranController');
        Route::group(['prefix' => 'layanan-perkantoran', 'as' => 'layanan-perkantoran.'], function () {
            Route::post('/', 'Backend\Pertanggungjawaban\Pj_PerkantoranController@search')->name('search');
            Route::get('{id}/detail-layanan', 'Backend\Pertanggungjawaban\Pj_PerkantoranController@detail')->name('detail');
            //Route::post('kirim-bendahara', 'Backend\Pertanggungjawaban\Pj_PerkantoranController@kirimBendahara')->name('kirim-bendahara');
            Route::post('{id}/simpan-detail', 'Backend\Pertanggungjawaban\Pj_PerkantoranController@simpanDetail')->name('simpan-detail');
        });
    });

    Route::group(['prefix' => 'monitoring', 'as' => 'monitoring.'], function () {
        Route::group(['prefix' => 'evaluasi-kegiatan', 'as' => 'evaluasi-kegiatan.'], function () {
            Route::get('sedang-diajukan', 'Backend\Monitoring\EvaluasiKegiatan\SedangDiajukanController@index')->name('sedang-diajukan');
            Route::post('sedang-diajukan', 'Backend\Monitoring\EvaluasiKegiatan\SedangDiajukanController@search')->name('sedang-diajukan.search');

            Route::get('sedang-dilaksanakan', 'Backend\Monitoring\EvaluasiKegiatan\SedangDilaksanakanController@index')->name('sedang-dilaksanakan');
            Route::post('sedang-dilaksanakan', 'Backend\Monitoring\EvaluasiKegiatan\SedangDilaksanakanController@search')->name('sedang-dilaksanakan.search');

            Route::get('selesai-dilaksanakan', 'Backend\Monitoring\EvaluasiKegiatan\SelesaiDilaksanakanController@index')->name('selesai-dilaksanakan');
            Route::post('selesai-dilaksanakan', 'Backend\Monitoring\EvaluasiKegiatan\SelesaiDilaksanakanController@search')->name('selesai-dilaksanakan.search');
        });

        Route::get('rpkrpd' , 'Backend\Monitoring\RpdController@index')->name('rpkrpd.index');
        Route::get('data-rkakl' ,'Backend\Monitoring\RpdController@data_rkakl')->name('rpkrpd.rkakl');
        Route::get('input_rpkrpd/{id}' , 'Backend\Monitoring\RpdController@input_data')->name('rpkrpd.input_rpkrpd');
        route::get('kuncirpkrpd/{id}' , 'Backend\Monitoring\RpdController@kunci_rpd')->name('rpkrpd.kunci_rpd');
        Route::get('cek_bulan/{id}/{bulan}' , 'Backend\Monitoring\RpdController@check_month_rpk')->name('rpkrpd.cek_bulan');
        Route::get('hitung' , 'Backend\Monitoring\RpdController@hitung')->name('rpkrpd.hitung');
        Route::get('generate' , 'Backend\Monitoring\RpdController@generate')->name('rpkrpd.generate');

        Route::post('simpan_rkakl' , 'Backend\Monitoring\RpdController@simpan_rkakl')->name('rpkrpd.simpan_rkakl');
        Route::post('simpan_rpk' , 'Backend\Monitoring\RpdController@simpan_rpk')->name('rpkrpd.simpan_rpk');
        Route::post('simpan_rpd' , 'Backend\Monitoring\RpdController@simpan_rpd')->name('rpkrpd.simpan_rpd');
        Route::delete('delete_rpk/{id}' , 'Backend\Monitoring\RpdController@hapus_rpk')->name('rpkrpd.hapus_rpk');
        Route::post('edit_rpk/{id}' , 'Backend\Monitoring\RpdController@edit_rpk')->name('rpkrpd.edit_rpk');
        Route::post('edit_rpd/{id}' , 'Backend\Monitoring\RpdController@edit_rpd')->name('rpkrpd.edit_rpd');
        Route::get('/rpd-report', 'Backend\Monitoring\RpdController@report')->name('rpkrpd.report');
        Route::get('/getreport', 'Backend\Monitoring\RpdController@get_report')->name('rpkrpd.getreport');



        Route::get('realisasi-anggaran', 'Backend\Monitoring\RealisasiAnggaranController@index')->name('realisasi-anggaran.index');
        Route::post('realisasi-anggaran', 'Backend\Monitoring\RealisasiAnggaranController@search')->name('realisasi-anggaran.search');
    });
});

Route::group(['middleware' => ['auth', 'role:bendahara']], function () {
    Route::group(['prefix' => 'pengajuan', 'as' => 'pengajuan.'], function () {
        Route::group(['prefix' => 'kegiatan', 'as' => 'kegiatan.'], function () {
            Route::post('simpan-bendahara', 'Backend\Pengajuan\KegiatanController@simpanBendahara')->name('simpan-bendahara');

            Route::get('{id}/sppd-terbit', 'Backend\Pengajuan\KegiatanController@sppdTerbit')->name('sppd-terbit');
            Route::get('draft-kegiatan/{id}/print-stpjb', 'Backend\Pengajuan\KegiatanController@sptjb')->name('draft-kegiatan.print-stpjb');
            Route::get('draft-kegiatan/{id}/print-stpjb-hotel', 'Backend\Pengajuan\KegiatanController@sptjb_hotel')->name('draft-kegiatan.print-stpjb-hotel');
        });

        Route::group(['prefix' => 'perjadin-dalam-negeri', 'as' => 'perjadin-dalam-negeri.'], function () {
            Route::POST('draft-perjadin/kirim-bendahara', 'Backend\Pengajuan\Perjadin\PerjadinController@kirimBendahara')->name('draft-perjadin.kirim-bendahara');

            Route::get('{id}/draft-perjadin/uang-diserahkan', 'Backend\Pengajuan\Perjadin\PerjadinController@uangDiserahkan')->name('draft-perjadin.uang-diserahkan');

            Route::get('{id}/draft-perjadin/tanda-terima', 'Backend\Pengajuan\Perjadin\PerjadinController@tandaTerima')->name('draft-perjadin.tanda-terima');
        });

        Route::group(['prefix' => 'perjadin-luar-negeri', 'as' => 'perjadin-luar-negeri.'], function () {
            Route::post('draft-perjadin/kirim-bendahara', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@kirimBendahara')->name('draft-perjadin.kirim-bendahara');

            Route::get('{id}/draft-perjadin/uang-diserahkan', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@uangDiserahkan')->name('draft-perjadin.uang-diserahkan');

            Route::get('{id}/draft-perjadin/tanda-terima', 'Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController@tandaTerima')->name('draft-perjadin.tanda-terima');
        });

        Route::group(['prefix' => 'layanan-perkantoran', 'as' => 'layanan-perkantoran.'], function () {
            Route::post('{id}/kirim-bendahara', 'Backend\Pengajuan\LayananPerkantoran\PerkantoranController@kirimBendahara')->name('kirim-bendahara');

            Route::get('{id}/serahkan-uang', 'Backend\Pengajuan\LayananPerkantoran\PerkantoranController@serahkanUang')->name('serahkan-uang');
        });
    });

    Route::group(['prefix' => 'pertanggungjawaban', 'as' => 'pertanggungjawaban.'], function () {
        Route::group(['prefix' => 'kegiatan', 'as' => 'kegiatan.'], function () {
            Route::post('{id}/kirim-pertanggungjawaban', 'Backend\Pertanggungjawaban\pj_kegiatanController@kirimpjbendahara')->name('kirim_pj');

            Route::get('{id}/selesai', 'Backend\Pertanggungjawaban\pj_kegiatanController@selesai')->name('selesai');
        });

        Route::group(['prefix' => 'perjadin-dalam-negeri', 'as' => 'perjadin-dalam-negeri.'], function () {
            Route::post('{id}/kirimbendahara', 'Backend\Pertanggungjawaban\Pj_PerjadinController@kirimbendahara')->name('kirimbendahara');
        });

        Route::group(['prefix' => 'perjadin-luar-negeri', 'as' => 'perjadin-luar-negeri.'], function () {
            Route::post('{id}/kirimbendahara', 'Backend\Pertanggungjawaban\Pj_PerjadinLuarNegriController@kirimbendahara')->name('kirimbendahara');
        });

        Route::group(['prefix' => 'layanan-perkantoran', 'as' => 'layanan-perkantoran.'], function () {
            Route::post('{id}/kirim-status', 'Backend\Pertanggungjawaban\Pj_PerkantoranController@kirimStatus')->name('kirim-status');

            Route::get('{id}/selesai', 'Backend\Pertanggungjawaban\Pj_PerkantoranController@selesai')->name('selesai');
        });
    });
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::group(['prefix' => 'pengajuan', 'as' => 'pengajuan.'], function () {
        Route::group(['prefix' => 'kegiatan', 'as' => 'kegiatan.'], function () {
            Route::get('{id}/terima-sppd', 'Backend\Pengajuan\KegiatanController@terimaSppd')->name('terima-sppd');

            Route::get('{id}/kirim-kegiatan', 'Backend\Pengajuan\KegiatanController@kirimKegiatan')->name('kirim-kegiatan');
        });
    });

    Route::group(['prefix' => 'pertanggungjawaban', 'as' => 'pertanggungjawaban.'], function () {
        Route::group(['prefix' => 'kegiatan', 'as' => 'kegiatan.'], function () {
            //            Route::get('{id}/kirim-pertanggungjawaban', 'Backend\Pertanggungjawaban\pj_kegiatanController@kirimPertanggungjawaban')->name('kirim-pertanggungjawaban');

            Route::post('{id}/simpan_detail', 'Backend\Pertanggungjawaban\pj_kegiatanController@simpanDetail')->name('simpan-detail');
        });

        Route::group(['prefix' => 'layanan-perkantoran', 'as' => 'layanan-perkantoran.'], function () {
            Route::get('{id}/kirim-pertanggungjawaban', 'Backend\Pertanggungjawaban\Pj_PerkantoranController@kirimPertanggungjawaban')->name('kirim-pertanggungjawaban');
        });
    });
});
        
        Route::group(['middleware' => ['auth', 'role:petugas_spm|user']], function () {
            Route::group(['prefix' => 'keuangan', 'as' => 'keuangan.'], function () {
                Route::resource('spm', 'Backend\Keuangan\spmController');
                Route::group(['prefix' => 'spm', 'as' => 'spm.'], function () {
                    // Route::get('index', 'Backend\Pengajuan\spmController@index')->name('keuangan.spm.index');
                    Route::get('{id}/spm_detail' , 'Backend\Keuangan\spmController@detail_spm')->name('detail_spm');
                    Route::get('{id}/kegiatan_list' , 'Backend\Keuangan\spmController@kegiatan_list')->name('kegiatan_list');
                    Route::post('simpan_kegiatan' , 'Backend\Keuangan\spmController@simpan_kegiatan')->name('simpan_kegiatan');
                });
                Route::resource('sas', 'Backend\Sas\sasController');
                Route::group(['prefix' => 'sas', 'as' => 'sas.'], function () {
                    Route::post('/upload_rkakl_temp' , 'Backend\Sas\sasController@upload_excel')->name('upload-excel');
                    Route::get('/dashboard/sas' , 'Backend\Sas\sasController@dashboard')->name('dashboard-sas');
                    Route::get('/dashboard/sas/realisasi' , 'Backend\Sas\sasController@realisasi')->name('dashboard-sas-realisasi');
                    Route::get('/dashboard/sas/jnsbel' , 'Backend\Sas\sasController@jenis_belanja')->name('dashboard-sas-jnsbel');
                    Route::get('/dashboard/spm' , 'Backend\Sas\sasController@get_spm_sp2d')->name('dashboard-spm-sp2d');
                });
                Route::resource('sp2d' , 'Backend\Sas\Sp2dController');
                Route::group(['prefix' => 'sp2d', 'as' => 'sp2d.'], function () {
                    Route::post('/upload/sp2d' , 'Backend\Sas\Sp2dController@upload_sp2d')->name('upload-sp2d');
                });


                Route::resource('kontrak', 'Backend\Keuangan\KontrakController');
                Route::group(['prefix' => 'kontrak' , 'as' => 'kontrak'] , function(){

                });
            });

        });

Route::group(['middleware' => ['auth', 'role:pimpinan']], function () {
    Route::group(['prefix' => 'pengajuan', 'as' => 'pengajuan.'], function () {
        Route::group(['prefix' => 'kegiatan', 'as' => 'kegiatan.'], function () {
            Route::get('{id}/persetujuan-direktur', 'Backend\Pengajuan\KegiatanController@persetujuanDirektur')->name('persetujuan-direktur');
        });
    });
});

Route::group(['middleware' => ['auth', 'role:ppk']], function () {
    Route::group(['prefix' => 'pengajuan', 'as' => 'pengajuan.'], function () {
        Route::group(['prefix' => 'kegiatan', 'as' => 'kegiatan.'], function () {
            Route::get('{id}/persetujuan-ppk', 'Backend\Pengajuan\KegiatanController@persetujuanPpk')->name('persetujuan-ppk');
        });
    });
});

Route::group(['middleware' => ['auth', 'role:administrator']], function () {
    Route::resource('user', 'User\UserController');
    Route::post('store', 'User\UserController@store')->name('user.store');
    Route::post('user', 'user\UserController@search')->name('user.search');

    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::resource('provinsi', 'Backend\Master\ProvinsiController');
        Route::post('provinsi/store', 'Backend\Master\ProvinsiController@store')->name('provinsi.store');
        Route::post('provinsi', 'Backend\Master\ProvinsiController@search')->name('provinsi.search');

        Route::resource('metodebayar', 'Backend\Master\MetodeBayarController');
        Route::post('metodebayar/store', 'Backend\Master\MetodeBayarController@store')->name('metodebayar.store');
        Route::post('metodebayar', 'Backend\Master\MetodeBayarController@search')->name('metodebayar.search');

        Route::get('rkakl', 'Backend\Master\RkaklController@index')->name('rkakl.index');
        Route::post('rkakl/import', 'Backend\Master\RkaklController@import')->name('rkakl.import');
        Route::post('rkakl', 'Backend\Master\RkaklController@search')->name('rkakl.search');

        Route::resource('jabatan', 'Backend\Master\JabatanController');
        Route::post('jabatan/store', 'Backend\Master\JabatanController@store')->name('jabatan.store');
        Route::post('jabatan', 'Backend\Master\JabatanController@search')->name('jabatan.search');

        Route::resource('bagian', 'Backend\Master\BagianController');
        Route::post('bagian/store', 'Backend\Master\BagianController@store')->name('bagian.store');
        Route::post('bagian', 'Backend\Master\BagianController@search')->name('bagian.search');

        Route::resource('pangkat', 'Backend\Master\PangkatController');
        Route::post('pangkat/store', 'Backend\Master\PangkatController@store')->name('pangkat.store');
        Route::post('pangkat', 'Backend\Master\PangkatController@search')->name('pangkat.search');

        Route::resource('status', 'Backend\Master\StatusController');
        Route::post('status/store', 'Backend\Master\StatusController@store')->name('status.store');
        Route::post('status', 'Backend\Master\statusController@search')->name('status.search');

        Route::resource('eselon', 'Backend\Master\EselonController');
        Route::post('eselon/store', 'Backend\Master\EselonController@store')->name('eselon.store');
        Route::post('eselon', 'Backend\Master\EselonController@search')->name('eselon.search');

        Route::resource('no-pengajuan', 'Backend\Master\NoPengajuanController');
        Route::post('no-pengajuan/store', 'Backend\Master\NoPengajuanController@store')->name('no-pengajuan.store');
        Route::post('no-pengajuan', 'Backend\Master\NoPengajuanController@search')->name('no-pengajuan.search');

        Route::resource('pegawai', 'Backend\Master\PegawaiController');
        Route::post('pegawai/store', 'Backend\Master\PegawaiController@store')->name('pegawai.store');
        Route::post('pegawai', 'Backend\Master\PegawaiController@search')->name('pegawai.search');

        Route::resource('kabkota', 'Backend\Master\KabkotaController');
        Route::post('kabkota/store', 'Backend\Master\KabkotaController@store')->name('kabkota.store');
        Route::post('kabkota', 'Backend\Master\KabkotaController@search')->name('kabkota.search');

        Route::resource('pengadaan', 'Backend\Master\PengadaanController');
        Route::post('pengadaan', 'Backend\Master\PengadaanController@search')->name('pengadaan.search');

        Route::resource('pimpinan', 'Backend\Master\PimpinanController');
        Route::post('pimpinan/store', 'Backend\Master\PimpinanController@store')->name('pimpinan.store');
        Route::post('pimpinan', 'Backend\Master\PimpinanController@search')->name('pimpinan.search');

        Route::resource('tamu', 'Backend\Master\TamuController');
        Route::post('tamu/store', 'Backend\Master\TamuController@store')->name('tamu.store');
        Route::post('tamu', 'Backend\Master\TamuController@search')->name('tamu.search');
        
    });
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        

        Route::resource('pegawai', 'Backend\Master\PegawaiController');
        Route::post('pegawai/store', 'Backend\Master\PegawaiController@store')->name('pegawai.store');
        Route::post('pegawai', 'Backend\Master\PegawaiController@search')->name('pegawai.search');
       
    });
});

Route::group(['middleware' => ['auth', 'role:user|bendahara|pimpinan|ppk|administrator']], function () {
    Route::group(['prefix' => 'sas', 'as' => 'pengajuan.'], function () {
        
        Route::group(['prefix' => 'sas', 'as' => 'kegiatan.'], function () {
            Route::post('store', 'Backend\Pengajuan\KegiatanController@store')->name('store');
            Route::post('/', 'Backend\Pengajuan\KegiatanController@search')->name('search');
            Route::any('memuat-mak/{judul?}', 'Backend\Pengajuan\KegiatanController@memuatMak')->name('memuat-mak');
            Route::any('memuat-uraian/{id?}', 'Backend\Pengajuan\KegiatanController@memuatUraian')->name('memuat-uraian');
            Route::get('{id}/nota-dinas', 'Backend\Pengajuan\KegiatanController@notaDinas')->name('nota-dinas');
            Route::get('{id}/surat-tugas', 'Backend\Pengajuan\KegiatanController@surat_tugas')->name('surat-tugas');

            Route::get('detail-akun/{id}', 'Backend\Pengajuan\DetailAkunController@detailAkun')->name('detail-akun');
            Route::delete('detail-akun/{id}/destroy', 'Backend\Pengajuan\DetailAkunController@destroy')->name('detail-akun.destroy');
            Route::post('detail-akun/{id}', 'Backend\Pengajuan\DetailAkunController@search')->name('detail-akun.search');

            Route::get('detail-akun/{id}/list-akun', 'Backend\Pengajuan\PilihAkunController@listAkun')->name('detail-akun.list-akun');
            Route::post('detail-akun/{id}/list-akun/store', 'Backend\Pengajuan\DetailKegiatanController@store')->name('detail-akun.list-akun.store');

            Route::get('list-pegawai/{id}', 'Backend\Pengajuan\PegawaiController@listPegawai')->name('list-pegawai');
            Route::post('pilih-pegawai/{id}', 'Backend\Pengajuan\PegawaiController@pilihPegawai')->name('pilih-pegawai');

            Route::get('draft-kegiatan/{id}', 'Backend\Pengajuan\KegiatanController@draftKegiatan')->name('draft-kegiatan');
            Route::delete('draft-kegiatan/{kegiatan_id}pegawai/destroy/{id}', 'Backend\Pengajuan\PegawaiController@destroy')->name('draft-kegiatan.pegawai.destroy');

            Route::get('draft-kegiatan/{id}/kuitansi-pembayaran', 'Backend\Pengajuan\KegiatanController@kuitansipembayaranlangsung')->name('draft-kegiatan.kuitansi-pembayaran');
            Route::get('draft-kegiatan/{id}/kuitansi-pembayaran-up', 'Backend\Pengajuan\KegiatanController@kuitansipembayaranlangsungUP')->name('draft-kegiatan.kuitansi-pembayaran-up');
            Route::get('draft-kegiatan/{id}/selesai', 'Backend\Pengajuan\KegiatanController@selesai_pengajuan')->name('draft-kegiatan.selesai_pengajuan');

            Route::get('nominatif/{id}', 'Backend\Pengajuan\NominatifController@index')->name('nominatif.index');
            Route::get('{kegiatan_id}/nominatif-fullday', 'Backend\Pengajuan\NominatifController@downloadNominatifFullday')->name('nominatif.nominatif-fullday');
            Route::get('{kegiatan_id}/nominatif-fullboard', 'Backend\Pengajuan\NominatifController@downloadNominatifFullboard')->name('nominatif.nominatif-fullboard');
            Route::get('nominatif/{id}/kuitansi-rill', 'Backend\Pengajuan\NominatifController@cetakRill')->name('nominatif.kuitansi-rill');
            //Route::post('nominatif/import-perjadin/{id}', 'Backend\Pengajuan\NominatifController@importPerjadin')->name('nominatif.import-perjadin');
            Route::post('nominatif/importPusat/{id}', 'Backend\Pengajuan\NominatifController@importPusat')->name('nominatif.importPusat');
            Route::post('nominatif/importLokal/{id}', 'Backend\Pengajuan\NominatifController@importLokal')->name('nominatif.importLokal');
            Route::post('nominatif/importPusatfb/{id}', 'Backend\Pengajuan\NominatifController@importPusatfb')->name('nominatif.importPusatfb');
            Route::post('nominatif/importDaerahfb/{id}', 'Backend\Pengajuan\NominatifController@importDaerahfb')->name('nominatif.importDaerahfb');
            Route::delete('nominatif/destroy/{id}', 'Backend\Pengajuan\NominatifController@destroy')->name('nominatif.destroy');
            //Route::delete('nominatif/deletePerjadin/{id}', 'Backend\Pengajuan\NominatifController@deletePerjadin')->name('nominatif.deletePerjadin');
            Route::delete('nominatif/fulldayLocal/{id}', 'Backend\Pengajuan\NominatifController@fulldayLocal')->name('nominatif.fulldayLocal');
            Route::delete('nominatif/fulldayPusat/{id}', 'Backend\Pengajuan\NominatifController@fulldayPusat')->name('nominatif.fulldayPusat');
            Route::delete('nominatif/nominatifDaerah/{id}', 'Backend\Pengajuan\NominatifController@nominatifDaerah')->name('nominatif.nominatifDaerah');
            Route::delete('nominatif/nominatifPusat/{id}', 'Backend\Pengajuan\NominatifController@nominatifPusat')->name('nominatif.nominatifPusat');
        });

    });

    
});