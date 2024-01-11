<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignOutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Route::get('signout', [SignOutController::class, 'sign_out'])->name('sign_out');
Route::get('login', [LoginController::class, 'login'])->name('login');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('books', 'App\Http\Controllers\BooksController');
    Route::resource('authors', 'App\Http\Controllers\AuthorsController');
    Route::resource('shelves', 'App\Http\Controllers\ShelvesController');
    Route::resource('genres', 'App\Http\Controllers\GenresController');
});
