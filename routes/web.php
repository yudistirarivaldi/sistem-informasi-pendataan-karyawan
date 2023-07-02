<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ScheduleController;

// Auth::routes();
Route::get('/help', function(){
    return view('help');
})->name('help');


Route::namespace('Auth')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->middleware('guest')->name('login');
    Route::post('/login', 'LoginController@login')->middleware('guest');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});


Route::middleware('auth')->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/getStaffPosition', 'HomeController@getStaffPosition');
    Route::get('/home/getStaffDepartement', 'HomeController@getStaffDepartement');

    //personal karyawan
    Route::get('/users/account/{id}/edit', 'UsersController@editAccount')->name('users.account.edit');
    Route::patch('/users/{id}/updateAccount', 'UsersController@updateAccount')->name('users.account.update');
    // profile
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/{id}/edit', 'ProfileController@editProfile')->name('profile.edit');
    Route::patch('/profile/{id}/update', 'ProfileController@updateProfile')->name('profile.update');
    Route::patch('/profile/upload', 'ProfileController@uploadPhoto')->name('profile.upload');

    Route::middleware('role:admin|superadmin')->group(function(){
        Route::get('/users', 'UsersController@index')->name('users.index');
        Route::patch('/users/{id}/update', 'UsersController@update')->name('users.update');
        Route::get('/users/{id}', 'UsersController@destroy')->name('users.destroy');

        Route::get('/roles', 'RolesController@index')->name('roles.index');
        Route::get('/roles/create', 'RolesController@create')->name('roles.create');
        Route::post('/roles', 'RolesController@store')->name('roles.store');
        Route::get('/roles/{roles}/edit', 'RolesController@edit')->name('roles.edit');
        Route::patch('/roles/{roles}/update', 'RolesController@update')->name('roles.update');
        Route::get('/roles/{id}', 'RolesController@destroy')->name('roles.destroy');
    });

    Route::middleware('role:admin|accounting|supervisor')->group(function(){
        Route::namespace('Master')->prefix('master')->name('master.')->group(function(){
            Route::get('position', 'PositionController@index')->name('position.index');
            Route::middleware('role:admin|accounting')->group(function(){
                Route::get('position/create', 'PositionController@create')->name('position.create');
                Route::post('position', 'PositionController@store')->name('position.store');
                Route::get('position/{position}/edit', 'PositionController@edit')->name('position.edit');
                Route::patch('position/{position}/update', 'PositionController@update')->name('position.update');
                Route::get('position/{id}', 'PositionController@destroy')->name('position.destroy');
            });

            Route::get('departement', 'DepartementController@index')->name('departement.index');
            Route::get('staff', 'StaffController@index')->name('staff.index');
            Route::middleware('role:admin|accounting')->group(function(){
                Route::get('departement/create', 'DepartementController@create')->name('departement.create');
                Route::post('departement', 'DepartementController@store')->name('departement.store');
                Route::get('departement/{departement}/edit', 'DepartementController@edit')->name('departement.edit');
                Route::patch('departement/{departement}/update', 'DepartementController@update')->name('departement.update');
                Route::get('departement/{id}', 'DepartementController@destroy')->name('departement.destroy');

                Route::get('staff/create', 'StaffController@create')->name('staff.create');
                Route::post('staff', 'StaffController@store')->name('staff.store');
                Route::get('staff/{staff}/edit', 'StaffController@edit')->name('staff.edit');
                Route::patch('staff/{staff}/update', 'StaffController@update')->name('staff.update');
                Route::get('staff/{id}', 'StaffController@destroy')->name('staff.destroy');
                Route::get('staff/export/excel', 'StaffController@excel')->name('staff.export.excel');


            });
        });

        Route::get('salary', 'SalaryController@index')->name('salary.index');
        Route::get('salary/detail/id={id}', 'SalaryController@show')->name('salary.show');



        Route::middleware('role:admin|accounting')->group(function(){
            Route::get('salary/create', 'SalaryController@create')->name('salary.create');
            Route::post('salary/detail/create', 'SalaryController@store')->name('salary.store');
            Route::post('salary/detail/create/store', 'SalaryController@storeDetail')->name('salary.detail.store');

            Route::get('salary/{salary}/edit', 'SalaryController@edit')->name('salary.edit');
            Route::patch('salary/{salary}/update', 'SalaryController@update')->name('salary.update');
            Route::get('salary/{id}', 'SalaryController@destroy')->name('salary.destroy');
            Route::get('staff/get_salary', 'SalaryController@getSalary');
            Route::get('salary/export/excel/id={id}/filter={filter}', 'SalaryController@excel')->name('salary.export.excel');

            Route::get('salary/export/pdf/id={id}/filter={filter}', 'SalaryController@pdf')->name('salary.export.pdf');

            Route::get('salary/export/pdf', 'SalaryController@pdfSemuaKaryawan')->name('salary.semua.export.pdf');


        });


        Route::get('absensi/export/excel/periode={periode}/filter={filter}', 'AbsensiController@excel')->name('absensi.export.excel');
        Route::get('absensi/export/pdf/periode={periode}/filter={filter}', 'AbsensiController@pdf')->name('absensi.export.pdf');

        Route::middleware('role:admin|accounting')->group(function(){
            Route::get('schedule/create', 'ScheduleController@create')->name('schedule.create');
            Route::post('schedule', 'ScheduleController@store')->name('schedule.store');
            Route::get('schedule/{schedule}/edit', 'ScheduleController@edit')->name('schedule.edit');
            Route::patch('schedule/{schedule}/update', 'ScheduleController@update')->name('schedule.update');
            Route::get('schedule/{id}', 'ScheduleController@destroy')->name('schedule.destroy');
            Route::get('schedule/export/excel', 'ScheduleController@excel')->name('schedule.export.excel');
            Route::get('schedule/export/pdf', 'ScheduleController@pdf')->name('schedule.export.pdf');

        });

    });

    Route::get('schedule', 'ScheduleController@index')->name('schedule.index');
    // cuti staff
    Route::get('cuti', 'CutiController@index')->name('cuti.index');
    Route::get('cuti/create', 'CutiController@create')->name('cuti.create');
    Route::post('cuti', 'CutiController@store')->name('cuti.store');
    Route::get('cuti/{cuti}/edit', 'CutiController@edit')->name('cuti.edit');
    Route::patch('cuti/{cuti}/update', 'CutiController@update')->name('cuti.update');
    Route::middleware('role:admin')->group(function(){
        Route::get('cuti/{id}', 'CutiController@destroy')->name('cuti.destroy');
        Route::patch('/cuti/{id}/validated', 'CutiController@validasi')->name('cuti.validated');
        Route::get('cuti/export/excel', 'CutiController@excel')->name('cuti.export.excel');
        Route::get('cuti/export/pdf', 'CutiController@pdf')->name('cuti.export.pdf');
    });

    Route::get('overtime', 'OvertimeController@index')->name('overtime.index');
    Route::get('overtime', 'OvertimeController@index')->name('overtime.index');
    Route::get('overtime/create', 'OvertimeController@create')->name('overtime.create');
    Route::post('overtime', 'OvertimeController@store')->name('overtime.store');
    Route::get('overtime/{overtime}/edit', 'OvertimeController@edit')->name('overtime.edit');
    Route::patch('overtime/{overtime}/update', 'OvertimeController@update')->name('overtime.update');
    Route::get('overtime/{id}', 'OvertimeController@destroy')->name('overtime.destroy');
    Route::middleware('role:admin')->group(function(){
        Route::get('overtime/export/excel', 'OvertimeController@excel')->name('overtime.export.excel');
        Route::get('overtime/export/pdf', 'OvertimeController@pdf')->name('overtime.export.pdf');
    });

        Route::get('absensi', 'AbsensiController@index')->name('absensi.index');
        Route::get('absensi/create', 'AbsensiController@create')->name('absensi.create');
        Route::post('absensi/detail/create', 'AbsensiController@store')->name('absensi.store');
        Route::get('absensi/delete/{id}', 'AbsensiController@destroy')->name('absensi.destroy');

        Route::get('absensi/detail/create', 'AbsensiController@createDetail')->name('absensi.detail.create');
        Route::post('absensi/detail/store', 'AbsensiController@storeDetail')->name('absensi.detail.store');
        Route::get('absensi/detail/periode={periode}', 'AbsensiController@show')->name('absensi.detail');

        Route::get('sanksi/create', 'SanksiController@create')->name('sanksi.create');
            Route::post('sanksi', 'SanksiController@store')->name('sanksi.store');
            Route::get('sanksi/{sanksi}/edit', 'SanksiController@edit')->name('sanksi.edit');
            Route::patch('sanksi/{sanksi}/update', 'SanksiController@update')->name('sanksi.update');
            Route::get('sanksi/{id}', 'SanksiController@destroy')->name('sanksi.destroy');
            Route::get('sanksi/export/excel', 'SanksiController@excel')->name('sanksi.export.excel');
            Route::get('sanksi/export/pdf', 'SanksiController@pdf')->name('sanksi.export.pdf');
            Route::get('sanksi', 'SanksiController@index')->name('sanksi.index');

            Route::get('mutasi/create', 'MutasiController@create')->name('mutasi.create');
            Route::post('mutasi', 'MutasiController@store')->name('mutasi.store');
            Route::get('mutasi/{mutasi}/edit', 'MutasiController@edit')->name('mutasi.edit');
            Route::patch('mutasi/{mutasi}/update', 'MutasiController@update')->name('mutasi.update');
            Route::get('mutasi/{id}', 'MutasiController@destroy')->name('mutasi.destroy');
            Route::get('mutasi/export/excel', 'MutasiController@excel')->name('mutasi.export.excel');
            Route::get('mutasi/export/pdf', 'MutasiController@pdf')->name('mutasi.export.pdf');
            Route::get('mutasi', 'MutasiController@index')->name('mutasi.index');


        Route::middleware('role:admin')->group(function(){
        Route::get('cuti/{id}', 'CutiController@destroy')->name('cuti.destroy');
        Route::patch('/cuti/{id}/validated', 'CutiController@validasi')->name('cuti.validated');
        Route::get('cuti/export/excel', 'CutiController@excel')->name('cuti.export.excel');
        Route::get('cuti/export/pdf', 'CutiController@pdf')->name('cuti.export.pdf');

    });


      Route::prefix('laporan')->name('laporan.')->group(function(){
        Route::middleware('role:admin')->group(function(){
        Route::get('laporan/karyawan', 'LaporanController@index')->name('karyawan.index');
        Route::get('laporan/jadwal_masuk', 'LaporanController@index_jadwal')->name('jadwal.index');
        Route::get('laporan/cuti', 'LaporanController@index_cuti')->name('cuti.index');
        Route::get('laporan/sanksi', 'LaporanController@index_sanksi')->name('sanksi.index');
        Route::get('laporan/mutasi', 'LaporanController@index_mutasi')->name('mutasi.index');
        Route::get('laporan/penggajian', 'LaporanController@index_penggajian')->name('gaji.index');
        Route::get('laporan/lembur', 'LaporanController@index_lembur')->name('lembur.index');

        Route::get('/staff/export/pdf/filter={filter}', 'LaporanController@pdf')->name('staff.export.pdf');
        Route::get('/jadwal/export/pdf/filter={filter}', 'LaporanController@pdf_jadwal')->name('jadwal.export.pdf');
        Route::get('/cuti/export/pdf/filter={filter}', 'LaporanController@pdf_cuti')->name('cuti.export.pdf');
        Route::get('/sanksi/export/pdf/filter={filter}', 'LaporanController@pdf_sanksi')->name('sanksi.export.pdf');
        Route::get('/mutasi/export/pdf/filter={filter}', 'LaporanController@pdf_mutasi')->name('mutasi.export.pdf');
        Route::get('/gaji/export/pdf/filter={filter}', 'LaporanController@pdf_gaji')->name('gaji.export.pdf');
        Route::get('/lembur/export/pdf/filter={filter}', 'LaporanController@pdf_lembur')->name('lembur.export.pdf');

        });

     });

});


