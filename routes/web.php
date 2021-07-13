<?php

// Default laravel page

use App\Http\Controllers\Admin\PenggunaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('admin.pages.login');
})->name('login');

Route::get('/register', function () {
    return view('admin.pages.register');
})->name('register');


// Admin Dashboard Route
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'LokasiController@getLokasi')->name('index');

    //POSTT Lokasi
    Route::post('/lokasi-table/tambahLokasi', 'LokasiController@tambahLokasi')->name('tambahLokasi');
    Route::post('/lokasi-table/tambahAlamat', 'LokasiController@tambahAlamat')->name('tambahAlamat');
    Route::post('/lokasi-table/updateLokasi', 'LokasiController@updateLokasi')->name('updateLokasi');
    // Route::post('/forms-datareference/submitJenisHT', 'HTController@insertJenisHT')->name('submitJenisHT');

    //POST Pengguna & Pegawai
    Route::post('/pengguna-table/tambahPengguna', 'PenggunaController@tambahDataPengguna')->name('tambahPengguna');
    Route::post('/pengguna-table/updatePengguna', 'PenggunaController@updateDataPengguna')->name('updatePengguna');
    Route::get('/pengguna-table/deletePengguna/{id_pengguna}', 'PenggunaController@deleteDataPengguna')->name('deletePengguna');

    Route::post('/pegawai-table/tambahPegawai', 'PenggunaController@tambahDataPegawai')->name('tambahPegawai');
    Route::post('/pegawai-table/updatePegawai', 'PenggunaController@updateDataPegawai')->name('updatePegawai');

    //POST List HT
    Route::post('/listHt-table/tambahHt', 'HTController@tambahHt')->name('tambahHt');
    Route::post('/listHt-table/updateHt', 'HTController@updateHt')->name('updateHt');

    //POST Alat
    Route::post('/listAlat-table/tambahAlat', 'HTController@tambahAlatBaru')->name('tambahAlatBaru');
    Route::post('/listAlat-table/updateAlat', 'HTController@updateAlat')->name('updateAlat');

    //POST Assign HT
    Route::post('/assignHtLokasi/tambahLokasi', 'LokasiController@tambahLokasi')->name('tambahLokasi');
    Route::post('/assignHtAlamat/tambahAlamat', 'LokasiController@tambahAlamat')->name('tambahAlamat');
    Route::post('/assignHt/tambahAssignedHt', 'HTController@assignHt')->name('tambahAssignedHt');
    Route::post('/assignHt/updateAssignedHt', 'HTController@updateAssignData')->name('updateAssignedHt');

    //POST Detail HT
    Route::post('/assignmentHtDetail/tambahHistoriStatus', 'DetailHtController@inputStatusBaru')->name('tambahHistoriStatus');
    Route::post('/assignmentHtDetail/withdrawHt', 'DetailHtController@withdrawHt')->name('withdrawHt');

    //GET Lokasi
    Route::get('/dataAlamat-table', 'LokasiController@getTableAlamat')->name('dataAlamat-table');
    Route::get('/lokasi-table', 'LokasiController@getTableLokasi')->name('lokasi-table');

    //GET Pengguna & Pegawai
    Route::get('/pengguna-table', 'PenggunaController@getPenggunaTable')->name('pengguna-table');
    Route::get('/pegawai-table', 'PenggunaController@getPegawaiTable')->name('pegawai-table');
    Route::get('/pegawai-table/deletePegawai/{id_pegawai}', 'PenggunaController@deleteDataPegawai')->name('deletePegawai');

    //GET List HT
    Route::get('/listHt-table', 'HTController@getTableHT')->name('listHt-table');
    Route::get('/listHt-table/deleteHt/{id_infoHt}', 'HTController@deleteHt')->name('deleteHt');

    //GET Detail HT
    Route::get('/detailHt-table', 'HTController@getDetailAssign')->name('detailHt-table');
    Route::get('/dataHtPerLokasi-table', 'HTController@getDataHtPerLokasi')->name('dataHtPerLokasi-table');

    //GET Alat
    Route::get('/listAlat-table', 'HTController@getTableAlat')->name('listAlat-table');
    Route::get('/listAlat-table/deleteAlat/{id_alat}', 'HTController@deleteAlat')->name('deleteAlat');

    //GET Assign HT
    Route::get('/assignmentHtDetail', 'DetailHtController@getAssignmentHtDetail')->name('assignmentHtDetail');
    Route::get('/assignHtLokasi', 'HTController@getLokasiAssign')->name('assignHtLokasi');
    Route::get('/assignHtAlamat', 'HTController@getTableAlamat')->name('assignHtAlamat');
    Route::get('/assignHt', 'HTController@getAssignHt')->name('assignHt');

    // Bawaan dari template
    Route::get('/alerts', function () {
        return view('admin.pages.alerts');
    })->name('alerts');

    Route::get('/buttons', function () {
        return view('admin.pages.buttons');
    })->name('buttons');

    Route::get('/dropdowns', function () {
        return view('admin.pages.dropdowns');
    })->name('dropdowns');

    Route::get('/modals', function () {
        return view('admin.pages.modals');
    })->name('modals');

    Route::get('/popovers', function () {
        return view('admin.pages.popovers');
    })->name('popovers');

    Route::get('/progress-bars', function () {
        return view('admin.pages.progress-bars');
    })->name('progress-bars');

    Route::get('/forms-basic', function () {
        return view('admin.pages.forms-basic');
    })->name('forms-basic');

    Route::get('/forms-advanced', function () {
        return view('admin.pages.forms-advanced');
    })->name('forms-advanced');

    Route::get('/simple-table', function () {
        return view('admin.pages.simple-table');
    })->name('simple-table');

    Route::get('/datatables', function () {
        return view('admin.pages.datatables');
    })->name('datatables');

    Route::get('/ui-colours', function () {
        return view('admin.pages.ui-colours');
    })->name('ui-colours');

    Route::get('/404', function () {
        return view('admin.pages.404');
    })->name('404');

    Route::get('/blank-page', function () {
        return view('admin.pages.blank-page');
    })->name('blank-page');

    Route::get('/charts', function () {
        return view('admin.pages.charts');
    })->name('charts');
});
