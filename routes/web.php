<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
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

// route Home page
Route::get('/', [HomeController::class, 'index']);
Route::get('/posts/{slug}', [PostController::class, 'detail'])->name('posts.detail');

// Route Middleware
Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route category
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories/simpan', [CategoryController::class, 'simpan'])->name('categories.simpan');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit']);
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{category_id}', [CategoryController::class, 'destory']);
    // Route Post
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::put('/posts/save', [PostController::class, 'simpanpost']);
    Route::get('/posts/{slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/delete/{id}', [PostController::class, 'hapus'])->name('posts.hapus');
});
