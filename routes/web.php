<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('cms.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

Route::prefix('cms')->middleware(['auth:user'])->group(function () {
    Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('send-verification', [EmailVerificationController::class, 'send'])->name('verification.send');
    Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');

});

Route::middleware(['auth:user','verified'])->group(function () {

    Route::get('/home', function () {
        return view('ControlPanel.parent');
    })->name('dashboard');
    Route::resource('notes', NoteController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

