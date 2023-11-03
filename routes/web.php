<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;


Route::group(['middleware'=> 'guest'], function () {

    Route::get('/', [UserController::class, 'registration'])->name('registration');
    Route::post('/register_store', [UserController::class, 'register_store'])->name('register_store');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'loginsuccess'])->name('loginsuccess');

});

Route::group(['middleware'=> 'auth'], function () {

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/index', function () {
        return view('pages.index');
    })->name('index');

    Route::get('/profile', function () {
        return view('pages.profile');
    })->name('profile');

    Route::get('/edit-profile', function () {
        return view('pages.edit-profile');
    })->name('edit-profile');


    Route::post('/update-profile', [UserController::class, 'update_profile'])->name('update-profile');

});