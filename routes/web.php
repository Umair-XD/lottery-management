<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TiresController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SmsVerificationController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Security\RequestValidator;

Route::middleware('auth')->group(function () {
    // 1. Show/send OTP form
    Route::get('sms/request',  [SmsVerificationController::class, 'showRequestForm'])->name('sms.request.form');
    Route::post('sms/request', [SmsVerificationController::class, 'sendOtp'])->name('sms.send');

    // 2. Show/handle OTP verification
    Route::get('sms/verify',   [SmsVerificationController::class, 'showVerifyForm'])->name('sms.verify.form');
    Route::post('sms/verify',  [SmsVerificationController::class, 'verifyOtp'])->name('sms.verify');
});

// Twilio delivery-status callback (public API):
// Route::post('api/twilio/status-callback', function (Request $req) {
//     Log::info('Twilio Callback', $req->all());
//     return response()->json(['received' => true]);
// })->name('twilio.callback');
Route::post('api/twilio/status-callback', function (Request $req) {
    $validator = new RequestValidator(config('services.twilio.token'));

    $signature = $req->header('X-Twilio-Signature');
    $url       = $req->fullUrl();
    $params    = $req->all();

    if (! $validator->validate($signature, $url, $params)) {
        Log::warning('⚠️ Invalid Twilio callback attempt', [
            'url' => $url,
            'params' => $params,
        ]);
        return response()->json(['error' => 'Invalid signature'], 403);
    }
    Log::info('Twilio Callback Verified', $params);

    return response()->json(['received' => true]);
})->name('twilio.callback');

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

Route::get('/ticket/cart/{id}', [TiresController::class, 'ticketShow'])->name('ticket.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin routes
Route::prefix('admin')->name('admin.')->middleware([
    'auth'
    // ,'role:admin'
])->group(function () {
    Route::resource('tires', TiresController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('products', ProductController::class);
});

require __DIR__ . '/auth.php';
