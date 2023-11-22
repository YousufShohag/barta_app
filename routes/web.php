<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [UserController::class, 'home'])->name('home');


    Route::get('/index', function () {
        return view('pages.index');
    })->name('index');

    Route::get('/profile', function () {
        return view('pages.profile');
    })->name('profile');

    Route::get('/edit-profile', function () {
        return view('pages.edit-profile');
    })->name('edit-profile');

    Route::post('/update-profile', [UserController::class, 'update_profile'])
                ->name('update-profile');

    Route::get('/home', [UserController::class, 'home'])
                ->name('home');

//! FOR POSTS ROUTE
    Route::post('/post', [PostController::class, 'post_register'])
                ->name('post_register');

    Route::get('/single-post/{id}', [PostController::class, 'single_post'])
                ->name('single-post');

    Route::get('/showPost/{uuid}/', [PostController::class, 'showPost'])
                ->name('showPost');

    Route::get('/deletePost/{uuid}/', [PostController::class, 'deletePost'])
                ->name('deletePost');

    Route::post('/updatePost/{uuid}/', [PostController::class, 'updatePost'])
                ->name('updatePost');

//! FOR SINGLE COMMENT ROUTE
Route::get('/comment/{uuid}', [CommentController::class, 'create'])
                ->name('comment');

Route::post('/store/{id}/', [CommentController::class, 'store'])
                ->name('store');
});

Route::get('/deleteComment/{uuid}/', [CommentController::class, 'destroy'])
                ->name('destroy');

Route::get('/showComment/{uuid}/', [CommentController::class, 'showComment'])
                ->name('showComment');

Route::post('/updateComment/{uuid}/', [CommentController::class, 'update'])
                ->name('updateComment');

require __DIR__.'/auth.php';
