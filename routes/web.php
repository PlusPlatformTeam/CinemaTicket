<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MovieController;
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

Route::get('/movie/{slug}', [MovieController::class, 'ShowMovie'])->name('movie.show');

Route::get('/login', [UserController::class, 'login'])->name('user.login');

Route::get('/register', [UserController::class, 'register'])->name('user.register');

Route::get('/register_verification', [UserController::class, 'RegisterVerification'])->name('user.register_verification');

Route::post('/search', [HomeController::class, 'Search'])->name('search');

Route::post('/login', [UserController::class, 'authenticate'])->name('user.authenticate');

Route::post('/register', [UserController::class, 'store'])->name('user.store.step-one');

Route::get('/city/all', [CityController::class, 'GetAll'])->name('city.all');
