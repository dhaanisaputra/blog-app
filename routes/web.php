<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommunityController;
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
        // Route::view('/settings', 'back.pages.settings')->name('settings');
        // Route::post('/change-blog-logo', [AuthorController::class, 'updateLogo'])->name('change-blog-logo');
        // Route::post('/change-blog-favicon', [AuthorController::class, 'updateFavicon'])->name('change-blog-favicon');
        // Route::view('/authors', 'back.pages.authors')->name('authors');
        // Route::view('/categories', 'back.pages.categories')->name('categories');

        // protect route only admin with middleware
        Route::middleware(['admin'])->group(function () {
            Route::view('/settings', 'back.pages.settings')->name('settings');
            Route::post('/change-blog-logo', [AuthorController::class, 'updateLogo'])->name('change-blog-logo');
            Route::post('/change-blog-favicon', [AuthorController::class, 'updateFavicon'])->name('change-blog-favicon');
            Route::view('/authors', 'back.pages.authors')->name('authors');
            Route::view('/categories', 'back.pages.categories')->name('categories');
        });


        Route::prefix('posts')->name('posts.')->group(function () {
            Route::view('/add-post', 'back.pages.add-post')->name('add-post');
            Route::post('/create', [AuthorController::class, 'createPost'])->name('create');
            Route::view('/all', 'back.pages.all-post')->name('all-post');
            Route::get('/edit-post', [AuthorController::class, 'editPost'])->name('edit-post');
            Route::post('/update-post', [AuthorController::class, 'updatePost'])->name('update-post');

            Route::view('/add-community', 'back.pages.add-community')->name('add-community');
            Route::post('/create-community', [CommunityController::class, 'createCommunity'])->name('create-community');
            Route::view('/all-community', 'back.pages.all-community')->name('all-community');
            Route::get('/edit-community', [CommunityController::class, 'editCommunity'])->name('edit-community');
            Route::post('/update-community', [CommunityController::class, 'updateCommunity'])->name('update-community');

            Route::view('/add-foty', 'back.pages.add-foty')->name('add-foty');
            Route::post('/create-foty', [CommunityController::class, 'createFoty'])->name('create-foty');
            Route::view('/all-foty', 'back.pages.all-foty')->name('all-foty');
            Route::get('/edit-foty', [CommunityController::class, 'editFoty'])->name('edit-foty');
            Route::post('/update-foty', [CommunityController::class, 'updateFoty'])->name('update-foty');
        });
    });
});

Route::view('/ykfb', 'front.pages.home');
Route::view('/ykfb-home', 'front.pages.ykfb');

Route::get('/article/{any}', [BlogController::class, 'readPost'])->name('read_post');
Route::get('/category/{any}', [BlogController::class, 'categoryPost'])->name('category_posts');
Route::get('/post-per-category/{any}', [BlogController::class, 'postPerCategory'])->name('posts_per_category');
Route::get('/posts/tag/{any}', [BlogController::class, 'tagPost'])->name('tag_posts');
Route::get('/search', [BlogController::class, 'searchBlog'])->name('search_posts');

Route::view('/about-me', 'front.pages.ykfb-about-me')->name('about-me');
Route::get('/community', [BlogController::class, 'listCommunity'])->name('community');
Route::get('/community/{any}', [BlogController::class, 'readCommunity'])->name('read_community');
// Route::view('/community', 'front.pages.ykfb-community')->name('community');
Route::get('/foty-idn', [BlogController::class, 'listFoty'])->name('foty-idn');
