<?php

use App\Http\Controllers\BlogApproveController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('blogs', BlogController::class);
    Route::patch('blogs/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blogs.toggle-status');

    Route::get('/all-blogs', [BlogController::class, 'blogs'])->name('blogs.all');
    Route::get('/view-blogs/{blog}', [BlogController::class, 'showBlog'])->name('blogs.view');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/blogs', [BlogApproveController::class, 'index'])->name('admin.blogs.index');
        Route::get('/admin/blogs/{blog}', [BlogApproveController::class, 'show'])->name('admin.blogs.show');
        Route::patch('/admin/blogs/{blog}/approve', [BlogApproveController::class, 'update'])->name('admin.blogs.approve');
        Route::delete('/admin/blogs/{blog}', [BlogApproveController::class, 'destroy'])->name('admin.blogs.destroy');
        Route::patch('/admin/blogs/{blog}/toggle-status', [BlogApproveController::class, 'toggleStatus'])->name('admin.blogs.toggle-status');
    });
});

require __DIR__ . '/auth.php';
