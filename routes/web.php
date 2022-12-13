<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
});

Route::get('/login',function() {
    return view('login/login');
})->name('get.login');

Route::get('/signup', function() {
    return view('sign_up.sign_up');
})->name('get.sign_up');

Route::post('/signup', [UserController::class, 'sign_up'])->name('sign_up');

// Route::post('/login', [UserController::class, ])