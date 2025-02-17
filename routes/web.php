<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DokterControllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login',[LoginController::class,"login"])->name("login");
Route::post('actionlogin',[LoginController::class,"actionlogin"])->name("actionlogin");
Route::get('/registrasi',[LoginController::class,"registrasi"])->name("registrasi");
Route::post('create',[LoginController::class,"create"])->name("create");

Route::middleware('auth')->group(function () {
    Route::resource('dktr',DokterControllers::class);
    Route::resource('ruangan',RuanganController::class);
    Route::get('actionlogout',[LoginController::class,"actionlogout"])->name("actionlogout");
    Route::get('password/reset', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('/profile/photo', [ProfileController::class, 'editPhoto'])->name('profile.photo');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
