<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


// Route::get('/login', [AuthorController::class, 'index'])->middleware('admin')->name('home');

Route::prefix('author')->name('author.')->group(function () {
    // Route::get('/login', [AuthorController::class, 'index'])->middleware('admin')->name('home');

    Route::middleware(['guest:web'])->group(function () {
        Route::view('/login', 'back.pages.auth.login')->name('login');
        Route::view('/forgot-password', 'back.pages.auth.forgot')->name('forgot-password');
    });
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/home', [AuthorController::class, 'index'])->name('home');
        Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');
        Route::view('/profile', 'back.pages.profile')->name('profile');
        Route::post('/change-profile-picture', [AuthorController::class, 'changeProfilePicture'])->name('change-profile-picture');
        Route::view('/settings', 'back.pages.settings')->name('settings');
        Route::post('/change-blog-logo', [AuthorController::class, 'updateLogo'])->name('change-blog-logo');
        Route::post('/change-blog-favicon', [AuthorController::class, 'updateFavicon'])->name('change-blog-favicon');
    });
});
