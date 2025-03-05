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
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/blogs', [BlogApproveController::class, 'index'])->name('admin.blogs.index');
        Route::get('/admin/blogs/{blog}', [BlogApproveController::class, 'show'])->name('admin.blogs.show');
        Route::post('/admin/blogs/{blog}/approve', [BlogApproveController::class, 'approve'])->name('admin.blogs.approve');
        Route::delete('/admin/blogs/{blog}', [BlogApproveController::class, 'destroy'])->name('admin.blogs.destroy');
    });
});

require __DIR__ . '/auth.php';
