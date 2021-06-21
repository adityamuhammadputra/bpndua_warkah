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

Route::get('/', function () {
    return redirect(url('login'));
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/detailpinjam/{id}', 'HomeController@detailpinjam');
    Route::post('api/modaldashboard','HomeController@apimodal');

    Route::resource('/peminjaman/register', 'PeminjamanRegisterController')->except('create','show');
    Route::get('api/peminjaman','PeminjamanRegisterController@apiPeminjaman');
    Route::patch('/peminjaman/registervalidasi/{id}', 'PeminjamanRegisterController@validasi');
    Route::patch('/peminjaman/registercetak/{id}', 'PeminjamanRegisterController@cetak');
    Route::get('api/jenishak','PeminjamanRegisterController@jenishak');
    Route::get('api/kecamatan','PeminjamanRegisterController@kecamatan');
    Route::get('api/desa','PeminjamanRegisterController@desa');

    Route::resource('/peminjaman/validasi', 'PeminjamanValidasiController')->only('index','store');
    Route::post('api/peminjamanvalidasi','PeminjamanValidasiController@apiPeminjamanValidasi');

    Route::get('autocompletepegawai','PeminjamanRegisterController@autoCompletePegawai');
    Route::get('autocompletepegawaishow','PeminjamanRegisterController@autoCompletePegawaiShow');


    Route::get('/peminjaman/monitoring', 'PeminjamanMonitoringController@index');
    Route::post('api/peminjamanmonitoring','PeminjamanMonitoringController@apiPeminjamanMonitoring');


    Route::resource('/pengembalian/validasi', 'PengembalianValidasiController')->only('index','store');
    Route::post('api/pengembalianvalidasi','PengembalianValidasiController@apiPengembalianValidasi');

    Route::get('/pengembalian/history', 'PengembalianHistoryController@index');
    Route::post('api/pengembalianhistory','PengembalianHistoryController@api');

    Route::resource('users', 'UserController')->except('create');
    Route::post('api/user', 'UserController@api');
    Route::post('api/cekusers', 'UserController@cekusers');

    Route::get('/user', 'UserController@user');

    Route::resource('userrole', 'UserRoleController')->except('create','show','update');
    Route::get('api/userrole', 'UserRoleController@apidata');

    Route::get('master/kegiatan', 'MasterController@indexkegiatan');
    Route::get('master/peminjam', 'MasterController@indexpeminjam');
    Route::get('master/warkah', 'MasterController@indexWarkah');
    Route::post('master/warkah/upload-excel','MasterController@uploadExcel');

    Route::post('datatable/master', 'MasterController@datatable');
    Route::get('master/{id}/edit/{type}', 'MasterController@edit');
    Route::resource('master', 'MasterController')->only('store', 'update');
    Route::delete('master/{id}/{type}', 'MasterController@destroy');
    Route::get('api/check-warkah','MasterController@checkWarkah');
    Route::get('api/autocomplete-warkah','MasterController@autoComplete');
    Route::get('api/show-autocomplete-warkah','MasterController@showAutoComplete');





    Route::get('/cetakall', 'PeminjamanRegisterController@cetakall');


    Route::get('storage/app/pdf/peminjaman/{filename}', function ($filename) {
        $path = storage_path('app/pdf/peminjaman/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });

    Route::get('/phpini', function () {
        phpinfo();
    });

});


