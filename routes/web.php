<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SansController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'Index'])->name('home');

Route::get('/cinema', [CinemaController::class, 'Index'])->name('cinema.index');
Route::get('/cinema/detail/{cinema}', [CinemaController::class, 'ShowCinema'])->name('cinema.show');
Route::post('/cinema/sort', [CinemaController::class, 'Sort'])->name('cinema.sort');
Route::post('/cinema/score', [CinemaController::class, 'Score'])->middleware('auth')->name('cinema.score');

Route::get('/movie/more', [MovieController::class, 'GetAll'])->name('movie.all');
Route::get('/movie/{slug}', [MovieController::class, 'ShowMovie'])->name('movie.show');
Route::post('/movie/score', [MovieController::class, 'Score'])->middleware('auth')->name('movie.score');

Route::get('/actor/{character}', [CharacterController::class, 'show'])->name('actor.show');


Route::get('/login', [UserController::class, 'login'])->name('user.login');

Route::get('/register', [UserController::class, 'register'])->name('user.register');

Route::get('/verification_code', [UserController::class, 'RegisterVerification'])->name('user.register_verification');

Route::post('/search', [HomeController::class, 'Search'])->name('search');

Route::post('/login', [UserController::class, 'authenticate'])->name('user.authenticate');

Route::post('/register', [UserController::class, 'store'])->name('user.store.step-one');

Route::post('/verification_code/register', [UserController::class, 'verifyCode'])->name('user.register.verify.code');

Route::post('/verification_code/login', [UserController::class, 'loginVerifyCode'])->name('user.login.verify.code');

Route::post('/resend-code', [UserController::class, 'resendCode'])->name('user.resend.code');

Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

Route::post('/profile', [UserController::class, 'profileUpdate'])->name('user.profile.update');

Route::post('/profile/avatar', [UserController::class, 'profileUpdateAvatar'])->name('user.profile.update.avatar');

Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');


Route::get('/transaction', [UserController::class, 'transaction'])->name('user.transaction');

Route::get('/tickets', [UserController::class, 'tickets'])->name('user.tickets');

Route::get('/ticket/choose-seat/{sans}', [SansController::class, 'Show'])->name('sans.show');

Route::get('/city/all', [CityController::class, 'GetAll'])->name('city.all');