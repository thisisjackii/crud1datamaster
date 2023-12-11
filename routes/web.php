<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PemasukanImportController;
use App\Http\Controllers\PemasukanReportController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PengeluaranReportController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\TransferController;
use App\Models\TransferSaldo;
use App\Http\Controllers\PengeluaranImportController;
use App\Http\Controllers\PinjamanImportController;
use App\Http\Controllers\PinjamanReportController;
use App\Http\Controllers\PinjamanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'dashboard/admin', 'middleware' => 'is_admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::post('update', [HomeController::class, 'updateprofile'])->name('profile.update');
    });

    Route::controller(AkunController::class)
        ->prefix('akun')
        ->as('akun.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get','post'],'tambah', 'tambahAkun')->name('add');
            Route::match(['get','post'],'{id}/ubah', 'ubahAkun')->name('edit');
            Route::delete('{id}/hapus', 'hapusAkun')->name('delete');
        });

    Route::controller(PemasukanController::class)
        ->prefix('pemasukan')
        ->as('pemasukan.')
        ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('showdata', 'dataTable')->name('dataTable');
        Route::match(['get','post'],'tambah', 'tambahPemasukan')->name('add');
        Route::match(['get','post'],'{id}/ubah', 'ubahPemasukan')->name('edit');
        Route::delete('{id}/hapus', 'hapusPemasukan')->name('delete');
        Route::get('pemasukan/export', 'export')->name('export');
        Route::get('pemasukan/generate', 'exportPdf')->name('exportPdf');;
        });

            Route::controller(PemasukanImportController::class)
            ->prefix('import')
            ->as('import.')
            ->group(function () {
                Route::post('/','index')->name('index');
            });

            Route::controller(PemasukanReportController::class)
            ->prefix('report')
            ->as('report.')
            ->group(function () {
                Route::post('/','index')->name('index');
            });

    Route::controller(PengeluaranController::class)
        ->prefix('pengeluaran')
        ->as('pengeluaran.')
        ->group(function () {
           Route::get('/', 'index')->name('index');
           Route::post('showdata', 'dataTable')->name('dataTable');
           Route::match(['get','post'],'tambah', 'tambahPengeluaran')->name('add');
           Route::match(['get','post'],'{id}/ubah', 'ubahPengeluaran')->name('edit');
           Route::delete('{id}/hapus', 'hapusPengeluaran')->name('delete');
           Route::get('pengeluaran/export', 'export')->name('export');
           Route::get('pengeluaran/generate', 'exportPdf')->name('exportPdf');;
        //    Route::post('/','import')->name('pengeluaran.import');     
        });

        Route::controller(PengeluaranImportController::class)
        ->prefix('import')
        ->as('import.')
        ->group(function () {
            Route::post('/','index')->name('index');
        });

        Route::controller(PengeluaranReportController::class)
        ->prefix('report')
        ->as('report.')
        ->group(function () {
            Route::post('/','index')->name('index');
        });


    Route::controller(HutangController::class)
        ->prefix('hutang')
        ->as('hutang.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get', 'post'], 'tambah', 'tambahHutang')->name('add');
            Route::match(['get', 'post'], '{id}/ubah', 'ubahHutang')->name('edit');
            Route::delete('{id}/hapus', 'hapusHutang')->name('delete');
        });

    Route::controller(PinjamanController::class)
        ->prefix('pinjaman')
        ->as('pinjaman.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get', 'post'], 'tambah', 'tambahPinjaman')->name('add');
            Route::match(['get', 'post'], '{id}/ubah', 'ubahPinjaman')->name('edit');
            Route::delete('{id}/hapus', 'hapusPinjaman')->name('delete');
            Route::get('pemasukan/export', 'export')->name('export');
            Route::get('pemasukan/generate', 'exportPdf')->name('exportPdf');;
        });

        Route::controller(PinjamanImportController::class)
        ->prefix('import')
        ->as('import.')
        ->group(function () {
              Route::post('/','index')->name('index');
        });

        Route::controller(PemasukanReportController::class)
            ->prefix('report')
            ->as('report.')
            ->group(function () {
                Route::post('/','index')->name('index');
            });

    Route::controller(TransferController::class)
    ->prefix('transfer_saldo')
    ->as('transfer_saldo.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('showdata', 'dataTable')->name('dataTable');
        Route::match(['get','post'],'tambah', 'tambahTransfer')->name('add');
        Route::match(['get','post'],'{id}/ubah', 'ubahTransfer')->name('edit');
        Route::delete('{id}/hapus', 'hapusTransfer')->name('delete');
    });        
});

Route::group(['prefix' => 'dashboard/admin'], function () {
    Route::controller(AkunController::class)
        ->prefix('akun')
        ->as('akun.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('showdata', 'dataTable')->name('dataTable');
            Route::match(['get','post'],'tambah', 'tambahAkun')->name('add');
            Route::match(['get','post'],'{id}/ubah', 'ubahAkun')->name('edit');
            Route::delete('{id}/hapus', 'hapusAkun')->name('delete');
        });
 
});