<?php

use App\Http\Controllers\Frontend\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;


Route::group(['middleware'=> 'guest'], function () {

    Route::get('/', [UserController::class, 'registration'])->name('registration');
    Route::post('/register_store', [UserController::class, 'register_store'])->name('register_store');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/home', [UserController::class, 'loginsuccess'])->name('loginsuccess');


});

Route::group(['middleware'=> 'auth'], function () {

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
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//! FOR POSTS ROUTE
    Route::post('/post', [PostController::class, 'post_register'])->name('post_register');
    Route::get('/single-post/{id}', [PostController::class, 'single_post'])->name('single-post');
    Route::get('/showPost/{uuid}/', [PostController::class, 'showPost'])->name('showPost');
    Route::get('/deletePost/{uuid}/', [PostController::class, 'deletePost'])->name('deletePost');
    Route::post('/updatePost/{uuid}/', [PostController::class, 'updatePost'])->name('updatePost');


});