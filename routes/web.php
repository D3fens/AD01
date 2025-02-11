<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;



Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login-proses',[LoginController::class,'login_proses'])->name('login-proses');
Route::get('logout',[LoginController::class,'logout'])->name('logout');

Route::get('register',[LoginController::class,'register'])->name('register');
Route::post('RegProcess',[LoginController::class,'register_proses'])->name('Reg.Process');

// Middleware
Route::middleware([AuthMiddleware::class])->group(function () {

    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('home');
    Route::get('/peserta',[HomeController::class,'peserta'])->name('data.peserta');
    Route::get('/data-peserta', [HomeController::class, 'index'])->name('data-peserta');

    Route::get('/edit-peserta/{id}', [HomeController::class, 'edit'])->name('edit.peserta');
    Route::put('/update-peserta/{id}', [HomeController::class, 'update'])->name('update.peserta');
    Route::delete('/delete-peserta/{id}', [HomeController::class, 'delete'])->name('delete.peserta');

    Route::get('/instruktur',[HomeController::class,'instruktur'])->name('data.instruktur');
    Route::get('/import-data-instruktur',[HomeController::class,'importdata_instruktur'])->name('importdata.instruktur');

    Route::get('/data_event',[HomeController::class,'data_event'])->name('data.event');
    Route::get('/tambahdata_event',[HomeController::class,'tambahdata_event'])->name('tambahData.event');

});

