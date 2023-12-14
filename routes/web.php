<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('admin.auth.login');
})->name('login');

//admin auth routes
Route::controller(AuthController::class)->name('admin.')->group(function(){
    Route::post('/login','login')->name('login');
    Route::get('/logout','logout')->name('logout');
});
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    //user routes
    Route::resource('user',UserController::class)->except(['create','show']);
    Route::controller(UserController::class)->name('user.')->prefix('user')->group(function () {
        Route::get('/update/status/{id}/{status}', 'updateStatus')->name('user_status');
    });
});