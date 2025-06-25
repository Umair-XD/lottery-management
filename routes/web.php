<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TiresController;
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
});

//Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth'
// ,'role:admin'
])->group(function () {
    Route::resource('tires', TiresController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('banners', BannerController::class);
});

Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users.index');
Route::get('/giving', [UserController::class, 'giving'])->middleware(['auth', 'verified'])->name('users.giving');
Route::get('/faq', [UserController::class, 'faq'])->middleware(['auth', 'verified'])->name('users.faq');

require __DIR__.'/auth.php';
