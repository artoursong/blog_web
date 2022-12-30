<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;

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
    return view('home/home');
})->name('home');

Route::get('/user/{id}', [UserController::class, 'index'])->name('get_info_user')->middleware(Authenticate::class);

Route::get('/user/information/{id}', [UserController::class, 'indexInfo'])->name('get_information_user')->middleware(Authenticate::class);

Route::get('/user/avatar/{id}', [UserController::class, 'indexAvatar'])->name('get_avatar_user')->middleware(Authenticate::class);

Route::get('/login',function() {
    return view('login/login');
})->name('get.login');

Route::get('/signup', function() {
    return view('sign_up.sign_up');
})->name('get.sign_up');

Route::post('/signup', [UserController::class, 'sign_up'])->name('sign_up');

Route::post('/login', [UserController::class, 'login'])->name('log_in');

Route::get('/logout', [UserController::class, 'logout'])->name('log_out');

Route::post('/user/{id}', [UserController::class,'update'])->name('update_info_user');

// Route::post('/login', [UserController::class, ])