<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TiresController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'index'])->name('users.index');
Route::get('/giving', [UserController::class, 'giving'])->name('users.giving');
Route::get('/faq', [UserController::class, 'faq'])->name('users.faq');
Route::get('/about', [UserController::class, 'about'])->name('users.about');
Route::get('/terms', [UserController::class, 'terms'])->name('users.terms');
Route::get('/privacy', [UserController::class, 'privacy'])->name('users.privacy');
Route::get('/contact', [UserController::class, 'contact'])->name('users.contact');
Route::post('/contact', [UserController::class, 'sendContact'])->name('users.sendContact');
Route::get('/winners', [UserController::class, 'winners'])->name('users.winners');
Route::get('/winners/{id}', [UserController::class, 'winnerDetails'])->name('users.winnerDetails');
Route::get('/rules', [UserController::class, 'rules'])->name('users.rules');

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

require __DIR__.'/auth.php';
