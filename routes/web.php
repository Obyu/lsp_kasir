<?php

use App\Http\Controllers\Admin\MejaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Kasir\TransactionController;
use App\Http\Controllers\OrderController;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});

Route::prefix('dashboard')->controller(DashboardController::class)->name('dashboard.')->group(function () {
    Route::get('/',  'index')->name('dashboard');
    Route::get('/kasir', 'index_kasir')->name('kasir');
    Route::get('/owner', 'index_owner')->name('owner');
    Route::get('/waiter', 'index_waiter')->name('waiter');
});

Route::prefix('meja')->controller(MejaController::class)->name('meja.')->group(function () {
    Route::get('/',  'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit', 'edit')->name('edit');
    Route::post('/store', 'store')->name('store');
    Route::delete('/delete/{id}', 'delete')->name('delete');
});

Route::prefix('menu')->controller(MenuController::class)->name('menu.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}','update')->name('update');
    Route::delete('/delete/{id}','delete')->name('delete');
});

Route::prefix('pelanggan')->controller(PelangganController::class)->name('pelanggan.')->group(function () {
    Route::get('/','index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store','store')->name('store');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::put('/update/{id}','update')->name('update');
    Route::delete('/delete/{id}','delete')->name('delete');
});

Route::prefix('pesanan')->controller(OrderController::class)->name('pesanan.')->group(function () {
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/addcart','AddToCart')->name('addcart');
    Route::post('/store/{id}','store')->name('store');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::get('/show/{id}','show')->name('show');
    Route::put('/update/{id}','update')->name('update');
    Route::delete('/delete/{id}','delete')->name('delete');
});

Route::prefix('transaction')->controller(TransactionController::class)->name('transaction.')->group(function () {
    Route::get('/','index')->name('index');
    Route::get('/Report','show')->name('report');
    Route::get('/create/{id}','create')->name('create');
    Route::post('/store','store')->name('store');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::put('/update/{id}','update')->name('update');
    Route::delete('/delete/{id}','delete')->name('delete');
    Route::get('/print/{id}','print')->name('print');
});

Route::prefix('login')->controller(LoginController::class)->name('login.')->group(function () {
    Route::get('/','index')->name('index');
    Route::post('/store','store')->name('store');
    Route::post('/logout','logout')->name('logout');
});

Route::get('/invoice', function () {
    return view('invoices.template');
});

