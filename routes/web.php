<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckCurrentUser;

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

Route::get('/', [BlogController::class, 'getNewBlogs'])->name('get_new_blogs');


Route::get('/user', [UserController::class, 'index'])->name('get_info_user')->middleware(Authenticate::class);

Route::get('user/profile/{id}', [UserController::class, 'showProfile'])->name('profile_user')->middleware(CheckCurrentUser::class);

Route::get('/user/edit_profile/{id}', [UserController::class, 'showEditProfile'])->name('get_edit_profile')->middleware(CheckCurrentUser::class);

Route::post('/user/{id}', [UserController::class,'update'])->name('update_info_user');

Route::post('/user/updatepass/{id}', [UserController::class,'updatePass'])->middleware(CheckCurrentUser::class)->name('update_pass');

Route::get('/user/updatepass/{id}', [UserController::class, 'getPassPage'])->middleware(CheckCurrentUser::class)->name('get_update_pass');

Route::get('/login',function() {
    session(['url.intended' => url()->previous()]);
    return view('login/login');
})->name('get.login');

Route::get('/signup', function() {
    return view('sign_up.sign_up');
})->name('get.sign_up');

Route::post('/signup', [UserController::class, 'sign_up'])->name('sign_up');

Route::post('/login', [UserController::class, 'login'])->name('log_in');

Route::get('/logout', [UserController::class, 'logout'])->name('log_out');



/*Blog Route*/

Route::get('/blog/create', [BlogController::class, 'getCreateForm'])->middleware(Authenticate::class)->name('getCreateForm');

Route::post('blog/create/{id}', [BlogController::class, 'createBlog'])->middleware(Authenticate::class)->name('createBlog');

Route::get('/blog/{slug}', [BlogController::class, 'getBlog'])->name('getBlog');

Route::get('/blog/blogs_user/{id}', [BlogController::class, 'getBlogsOfUser'])->middleware(CheckCurrentUser::class)->name('blogsOfUser');

/*Blog Route End*/

/*CKFinder Route*/

## /routes/web.php
// Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//     ->name('ckfinder_connector');

// Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//     ->name('ckfinder_browser');

	
Route::post('ckeditor/image_upload', [CKEditorController::class, 'upload'])->name('upload');


//Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
//    ->name('ckfinder_examples');

/*END CKFinder Route*/

/*Comment route*/

Route::post('comment/{id}', [CommentController::class, 'addComment'])->middleware(Authenticate::class)->name('addComment');