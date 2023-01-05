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

Route::get('user/profile/{id}', [UserController::class, 'showProfile'])->name('profile_user')->middleware(Authenticate::class);

Route::get('/user/edit_profile/{id}', [UserController::class, 'showEditProfile'])->name('get_edit_profile')->middleware(Authenticate::class);

Route::post('/user/{id}', [UserController::class,'update'])->name('update_info_user');

Route::post('/user/updatepass/{id}', [UserController::class,'updatePass'])->middleware(Authenticate::class)->name('update_pass');

Route::get('/user/updatepass/{id}', [UserController::class, 'getPassPage'])->middleware(Authenticate::class)->name('get_update_pass');

Route::get('/login',function() {
    return view('login/login');
})->name('get.login');

Route::get('/signup', function() {
    return view('sign_up.sign_up');
})->name('get.sign_up');

Route::post('/signup', [UserController::class, 'sign_up'])->name('sign_up');

Route::post('/login', [UserController::class, 'login'])->name('log_in');

Route::get('/logout', [UserController::class, 'logout'])->name('log_out');



// Route::post('/login', [UserController::class, ])