<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;

Route::get('/', [AdminAuthController::class, 'index'])->name('index');
Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AdminAuthController::class, 'login']);
Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::get('register', [AdminAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AdminAuthController::class, 'register']);

Route::middleware(['auth', 'admin'])->group(function () {
  
    Route::get('/admin/dashboard', [BlogController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{slug}/edit', [BlogController::class,'edit'])->name('blogs.edit');
    Route::put('/blogs/{slug}', [BlogController::class,'update'])->name('blogs.update');  
    Route::delete('/blogs/{slug}', [BlogController::class,'destroy'])->name('blogs.destroy');

});
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::post('/blogs/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/blog/{id}/comments', [CommentController::class, 'loadMoreComments']);
