<?php

Route::get('admin/login', 'Auth\AdminAuthController@getLogin')->name('admin.login');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin');

Route::get('/login', 'Auth\UserAuthController@getLogin')->name('user.login');
Route::post('/login', 'Auth\UserAuthController@postLogin');

Route::middleware('auth:admin')->group(function () {
    //GET Index
    Route::get('admin/home', 'Main\LokasiController@getLokasi')->name('admin.index');
    Route::get('admin/logout', 'Auth\AdminAuthController@postLogout')->name('admin.logout');

    //POST Lokasi
    Route::post('/lokasi-table/tambahLokasi', 'Main\LokasiController@tambahLokasi')->name('tambahLokasi');
    Route::post('/lokasi-table/tambahAlamat', 'Main\LokasiController@tambahAlamat')->name('tambahAlamat');
    Route::post('/lokasi-table/updateLokasi', 'Main\LokasiController@updateLokasi')->name('updateLokasi');

    //POST Pengguna & Pegawai
    Route::post('/pengguna-table/tambahPengguna', 'Main\PenggunaController@tambahDataPengguna')->name('tambahPengguna');
    Route::post('/pengguna-table/updatePengguna', 'Main\PenggunaController@updateDataPengguna')->name('updatePengguna');
    Route::get('/pengguna-table/deletePengguna/{id_pengguna}', 'Main\PenggunaController@deleteDataPengguna')->name('deletePengguna');

    Route::post('/pegawai-table/tambahPegawai', 'Main\PenggunaController@tambahDataPegawai')->name('tambahPegawai');
    Route::post('/pegawai-table/updatePegawai', 'Main\PenggunaController@updateDataPegawai')->name('updatePegawai');

    //POST List HT
    Route::post('/listHt-table/tambahHt', 'Main\HTController@tambahHt')->name('tambahHt');
    Route::post('/listHt-table/updateHt', 'Main\HTController@updateHt')->name('updateHt');

    //POST Alat
    Route::post('/listAlat-table/tambahMerkAlat', 'Main\HTController@tambahMerkAlatBaru')->name('tambahMerkAlatBaru');
    Route::post('/listAlat-table/updateMerk', 'Main\HTController@updateMerk')->name('updateMerk');
    Route::post('/listAlat-table/tambahJenisAlat', 'Main\HTController@tambahJenisAlatBaru')->name('tambahJenisAlatBaru');
    Route::post('/listAlat-table/updateJenis', 'Main\HTController@updateJenis')->name('updateJenis');

    //GET Lokasi
    Route::get('/lokasi-table', 'Main\LokasiController@getTableLokasi')->name('lokasi-table');

    //GET Pengguna & Pegawai
    Route::get('/pengguna-table', 'Main\PenggunaController@getPenggunaTable')->name('pengguna-table');
    Route::get('/pegawai-table/deletePegawai/{id_pengguna}', 'Main\PenggunaController@deleteDataPengguna')->name('deletePengguna');

    //GET List HT
    Route::get('/listHt-table', 'Main\HTController@getTableHT')->name('listHt-table');
    Route::get('/listHt-table/deleteHt/{id_infoHt}', 'Main\HTController@deleteHt')->name('deleteHt');

    //GET Alat
    Route::get('/listAlat-table', 'Main\HTController@getTableAlat')->name('listAlat-table');
    Route::get('/listAlat-table/deleteMerkHt/{id_merk}', 'Main\HTController@deleteMerkHt')->name('deleteMerkHt');
    Route::get('/listAlat-table/deleteJenisHt/{id_jenis}', 'Main\HTController@deleteJenis')->name('deleteJenisHt');

    //USER SETTINGS
    Route::get('/dataAdmin', 'Main\UserController@getAdminData')->name('dataAdmin');
    Route::get('/dataAdmin/deleteAdminData/{id_user}', 'Main\UserController@deleteAdminData')->name('deleteAdminData');
    Route::post('/dataAdmin/updateAdminData', 'Main\UserController@updateAdminData')->name('updateAdminData');
    Route::post('/dataAdmin/addAdminData', 'Main\UserController@addAdminData')->name('addAdminData');

    Route::get('/dataUser', 'Main\UserController@getUserData')->name('dataUser');
    Route::get('/dataUser/deleteUserData/{id_user}', 'Main\UserController@deleteUserData')->name('deleteUserData');
    Route::post('/dataUser/updateUserData', 'Main\UserController@updateUserData')->name('updateUserData');
    Route::post('/dataUser/addUserData', 'Main\UserController@addUserData')->name('addUserData');
});

Route::middleware('auth:user')->group(function () {
    //GET Index
    Route::get('user/home', 'Main\LokasiController@getLokasi')->name('user.index');
    Route::get('/logout', 'Auth\UserAuthController@postLogout')->name('user.logout');
});

//GET Detail HT
Route::get('/dataAlamat-table', 'Main\LokasiController@getTableAlamat')->name('dataAlamat-table');
Route::get('/dataHtPerLokasi-table', 'Main\HTController@getDataHtPerLokasi')->name('dataHtPerLokasi-table');
Route::get('/assignHt/{filename}', 'Main\HTController@getFile')->name('getFile');
Route::get('/detailHt-table', 'Main\HTController@getDetailAssign')->name('detailHt-table');

//POST Assign HT
Route::post('/assignHtLokasi/tambahLokasi', 'Main\LokasiController@tambahLokasi')->name('tambahLokasi');
Route::post('/assignHtAlamat/tambahAlamat', 'Main\LokasiController@tambahAlamat')->name('tambahAlamat');
Route::post('/assignHt/tambahAssignedHt', 'Main\HTController@assignHt')->name('tambahAssignedHt');
Route::post('/assignHt/updateAssignedHt', 'Main\HTController@updateAssignData')->name('updateAssignedHt');

//POST Detail HT
Route::post('/assignmentHtDetail/tambahHistoriStatus', 'Main\DetailHtController@inputStatusBaru')->name('tambahHistoriStatus');
Route::post('/assignmentHtDetail/withdrawHt', 'Main\DetailHtController@withdrawHt')->name('withdrawHt');

//GET Assign HT
Route::get('/assignmentHtDetail', 'Main\DetailHtController@getAssignmentHtDetail')->name('assignmentHtDetail');
Route::get('/assignmentHtDetail/{filename}', 'Main\DetailHtController@getGambarHT')->name('getGambarHT');
Route::get('/assignHtLokasi', 'Main\HTController@getLokasiAssign')->name('assignHtLokasi');
Route::get('/assignHtAlamat', 'Main\HTController@getTableAlamat')->name('assignHtAlamat');
Route::get('/assignHt', 'Main\HTController@getAssignHt')->name('assignHt');

//404
Route::get('/404', function () {
    return view('pages.404');
})->name('404');
