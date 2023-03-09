<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostsController::class, 'index'])->name('home');
Route::resource('posts', PostsController::class);
Route::resource('comments', CommentController::class)
    ->only('store', 'edit', 'update', 'destroy');
