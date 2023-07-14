<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CinemaController;
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

Route::get('/', [HomeController::class, 'Index']);

Route::get('/cinema', [CinemaController::class, 'Index'])->name('cinema.index');

Route::get('/movie/{slug}', [MovieController::class, 'Index']);

Route::get('/login', [UserController::class, 'login'])->name('user.login');

Route::get('/register', [UserController::class, 'register'])->name('user.register');

Route::get('/register_verification', [UserController::class, 'register_verification'])->name('user.register_verification');




