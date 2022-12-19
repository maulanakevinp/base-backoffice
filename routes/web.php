<?php

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
Route::view('/internet-terputus-harap-menyambungkan-ulang-koneksi-internet-anda','offline')->name('home.offline');

Route::get('/', function () {
    return redirect('/masuk');
});

Route::group(['middleware' => ['web', 'guest']], function () {
    Route::get('/masuk', 'AuthController@index')->name('masuk');
    Route::post('/masuk', 'AuthController@masuk');
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/log-activity/{activity_log}', 'HomeController@log_activity')->name('log-activity.show');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/notifikasi', 'HomeController@notifikasi')->name('notifikasi');
    Route::view('/home', 'home');
    Route::post('/keluar', 'AuthController@keluar')->name('keluar');

    Route::get('/pengaturan', 'UserController@pengaturan')->name('pengaturan');
    Route::get('/profil', 'UserController@profil')->name('profil');
    Route::patch('/update-pengaturan/{user}', 'UserController@updatePengaturan')->name('update-pengaturan');
    Route::patch('/update-profil/{id}', 'UserController@updateProfil')->name('update-profil');
    Route::patch('/update-avatar/{id}', 'UserController@updateAvatar')->name('update-avatar');

    Route::put('/data-pribadi/{data_pribadi}', 'DataPribadiController@update')->name('data-pribadi.update');
    Route::put('/detail-kontak/{detail_kontak}', 'DetailKontakController@update')->name('detail-kontak.update');

    Route::get('/lampiran/{lampiran}/download', 'LampiranController@download')->name('lampiran.download');
    Route::resource('/lampiran', 'LampiranController')->except('index','create','edit','destroy');
    Route::delete('/lampiran', 'LampiranController@destroy')->name('lampiran.destroy');

    Route::group(['middleware' => ['peran']], function () {
        Route::resource('pengguna', 'UserController')->except('destroy','create');
        Route::delete('/pengguna', 'UserController@destroy')->name('pengguna.destroy');

        Route::resource('peran', 'PeranController')->except('destroy','create','show');
        Route::delete('/peran', 'PeranController@destroy')->name('peran.destroy');
        Route::prefix('peran')->group(function () {
            Route::post('/update-kunci/{peran}', 'PeranController@update_kunci')->name('peran.update-kunci');
            Route::post('/peran-judul-menu', 'PeranJudulMenuController@store')->name('peran-judul-menu.store');
            Route::delete('/peran-judul-menu/{peran_judul_menu}', 'PeranJudulMenuController@destroy')->name('peran-judul-menu.destroy');

            Route::post('/judul-menu-menu', 'JudulMenuMenuController@store')->name('judul-menu-menu.store');
            Route::delete('/judul-menu-menu/{judul_menu_menu}', 'JudulMenuMenuController@destroy')->name('judul-menu-menu.destroy');

            Route::post('/menu-submenu', 'MenuSubmenuController@store')->name('menu-submenu.store');
            Route::delete('/menu-submenu/{menu_submenu}', 'MenuSubmenuController@destroy')->name('menu-submenu.destroy');

            Route::post('/submenu-sub-submenu', 'SubmenuSubSubmenuController@store')->name('submenu-sub-submenu.store');
            Route::delete('/submenu-sub-submenu/{submenu_sub_submenu}', 'SubmenuSubSubmenuController@destroy')->name('submenu-sub-submenu.destroy');

        });

        Route::resource('informasi-umum', 'InformasiUmumController')->except('destroy','create','edit','store','show');

        Route::prefix('database')->group(function () {
            Route::get('/', 'DatabaseController@index')->name('database.index');
            Route::get('/backup', 'DatabaseController@backup')->name('database.backup');
            Route::post('/restore', 'DatabaseController@restore')->name('database.restore');

            Route::get('/folder/backup', 'DatabaseController@folder_backup')->name('folder.backup');
            Route::post('/folder/restore', 'DatabaseController@folder_restore')->name('folder.restore');
        });

        Route::resource('menu', 'MenuController')->except('destroy','create','edit');
        Route::delete('/menu', 'MenuController@destroy')->name('menu.destroy');
        Route::post('/menu/urutan', 'MenuController@urutan')->name('menu.urutan');

        Route::get('/menu/{menu_id}/submenu', 'SubmenuController@index')->name('submenu.index');
        Route::post('/menu/submenu', 'SubmenuController@store')->name('submenu.store');
        Route::get('/menu/submenu/{submenu}', 'SubmenuController@show')->name('submenu.show');
        Route::put('/menu/submenu/{submenu}', 'SubmenuController@update')->name('submenu.update');
        Route::delete('/menu/submenu', 'SubmenuController@destroy')->name('submenu.destroy');
        Route::post('/menu/submenu/urutan', 'SubmenuController@urutan')->name('submenu.urutan');

        Route::get('/menu/{submenu_id}/sub-submenu', 'SubSubmenuController@index')->name('sub-submenu.index');
        Route::post('/menu/sub-submenu', 'SubSubmenuController@store')->name('sub-submenu.store');
        Route::get('/menu/sub-submenu/{submenu}', 'SubSubmenuController@show')->name('sub-submenu.show');
        Route::put('/menu/sub-submenu/{submenu}', 'SubSubmenuController@update')->name('sub-submenu.update');
        Route::delete('/menu/sub-submenu', 'SubSubmenuController@destroy')->name('sub-submenu.destroy');
        Route::post('/menu/sub-submenu/urutan', 'SubSubmenuController@urutan')->name('sub-submenu.urutan');
    });
});

Route::fallback(function () {
    abort(404);
});
