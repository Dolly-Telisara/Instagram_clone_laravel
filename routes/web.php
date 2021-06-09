<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use App\Mail\NewUserWelcomeMail;


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


Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});

Route::post('follow/{user}',[FollowsController::class,'store']);

Route::get('/', [PostsController::class,'index']);
Route::get('/p/create',[PostsController::class,'create']);
Route::post('/p',[PostsController::class,'store']);
Route::get('/p/{post}',[PostsController::class,'show']);


Route::get('/profile/{user}',[ProfileController::class,'index']);
Route::get('/profile/{user}/edit',[ProfileController::class,'edit']);
Route::patch('/profile/{user}',[ProfileController::class,'update']);

