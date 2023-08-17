<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SansController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;

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

// Cinemas
Route::get('/cinema', [CinemaController::class, 'Index'])->middleware('web')->name('cinema.index');
Route::get('/cinema/detail/{cinema}', [CinemaController::class, 'ShowCinema'])->name('cinema.show');
Route::post('/cinema/sort', [CinemaController::class, 'Sort'])->name('cinema.sort');
Route::post('/cinema/score', [CinemaController::class, 'Score'])->middleware('auth')->name('cinema.score');
Route::group(['middleware' => 'admin', 'prefix' => '/manage/cinema'], function($router){
    $router->get('/', [CinemaController::class, 'ManageCinemas'])->name('admin.manage.cinemas.show');
    $router->post('/', [CinemaController::class, 'Create'])->name('admin.manage.cinemas.create');
    $router->post('/update', [CinemaController::class, 'Update'])->name('admin.manage.cinemas.update');
    $router->delete('/', [CinemaController::class, 'Delete'])->name('admin.manage.cinemas.delete');
});

// Movies
Route::get('/movie/more', [MovieController::class, 'GetAll'])->name('movie.all');
Route::get('/movie/{movie}', [MovieController::class, 'ShowMovie'])->name('movie.show');
Route::post('/movie/score', [MovieController::class, 'Score'])->middleware('auth')->name('movie.score');
Route::group(['middleware' => 'admin', 'prefix' => '/manage/movie'], function($router){
    $router->get('/', [MovieController::class, 'ManageMovies'])->name('admin.manage.movies.show');
    $router->post('/', [MovieController::class, 'Create'])->name('admin.manage.movies.create');
    $router->put('/', [MovieController::class, 'Update'])->name('admin.manage.movies.update');
    $router->delete('/', [MovieController::class, 'Delete'])->name('admin.manage.movies.delete');
});

// Categories
Route::group(['middleware' => 'admin', 'prefix' => '/manage/category'], function($router){
    $router->get('/', [CategoryController::class, 'Show'])->name('admin.manage.categories');
    $router->post('/', [CategoryController::class, 'Create'])->name('admin.manage.category.create');
    $router->put('/', [CategoryController::class, 'Update'])->name('admin.manage.category.update');
    $router->delete('/', [CategoryController::class, 'Delete'])->name('admin.manage.category.delete');
});

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

Route::post('/addComment', [CommentController::class, 'addComment'])->name('comment.add');

Route::get('/transaction', [UserController::class, 'transaction'])->name('user.transaction');

Route::get('/tickets', [UserController::class, 'tickets'])->name('user.tickets');

Route::get('/ticket/choose-seat/{sans}', [SansController::class, 'Show'])->name('sans.show');

// City
Route::get('/city/all', [CityController::class, 'GetAll'])->name('city.all');
Route::group(['middleware' => 'admin', 'prefix' => '/manage/cities'], function($router){
    $router->get('/', [CityController::class, 'Show'])->name('admin.manage.cities');
    $router->post('/', [CityController::class, 'Create'])->name('admin.manage.city.create');
    $router->put('/', [CityController::class, 'Update'])->name('admin.manage.city.update');
    $router->delete('/', [CityController::class, 'Delete'])->name('admin.manage.city.delete');
});

Route::group(['middleware' => 'admin', 'prefix' => '/admin1'], function($router){
    $router->get('/', [AdminController::class, 'Index'])->name('admin.dashboard');
});
Route::group(['middleware' => 'admin', 'prefix' => '/admin1/manage'], function($router){
    $router->get('/users', [AdminController::class, 'Users'])->name('admin.manage.users');
    $router->get('/characters', [AdminController::class, 'Characters'])->name('admin.manage.characters');
    $router->get('/provinces', [AdminController::class, 'Provinces'])->name('admin.manage.provinces');
    $router->get('/comments', [AdminController::class, 'Comments'])->name('admin.manage.comments');
    $router->get('/factors', [AdminController::class, 'Factors'])->name('admin.manage.factors');
    $router->get('/halls', [AdminController::class, 'Halls'])->name('admin.manage.halls');
    $router->get('/options', [AdminController::class, 'Options'])->name('admin.manage.options');
    $router->get('/sans', [AdminController::class, 'Sans'])->name('admin.manage.sans');
    $router->get('/tickets', [AdminController::class, 'Tickets'])->name('admin.manage.tickets');

});
Route::post('/ticket/preFactor', [SansController::class, 'preFactor'])->name('sans.preFactor');

Route::post('/ticket/buy', [SansController::class, 'buy'])->name('sans.buy');

