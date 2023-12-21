<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Doctor\ChamberController;
use App\Http\Controllers\Admin\Doctor\DepartmentController;
use App\Http\Controllers\Admin\Doctor\SpecialityController;
use App\Http\Controllers\Admin\Language\LanguageChangeController;
use App\Http\Controllers\Admin\Language\LanguageController;
use App\Http\Controllers\Admin\Language\LocalizationController;
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
    Route::get('/admin/profile','profile')->name('profile');
    Route::post('/update-basic-info','updateBasicInfo')->name('update_basic_info');
    Route::post('/update-password','updatePassword')->name('update_basic_info');
});
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    //user routes
    Route::resource('user',UserController::class)->except(['create','show']);
    Route::controller(UserController::class)->name('user.')->prefix('user')->group(function () {
        Route::get('/update/status/{id}/{status}', 'updateStatus')->name('user_status');
    });

    //doctor section 

    //doctor chambers 
    Route::resource('doctor/chamber',ChamberController::class)->except(['create','show']);
    Route::controller(ChamberController::class)->name('chamber.')->prefix('doctor/chamber')->group(function () {
        Route::get('/update/status/{id}/{status}', 'updateStatus')->name('chamber_status');
    });

    //doctor speciality
    Route::resource('doctor/speciality',SpecialityController::class)->except(['create','show']);
    Route::controller(SpecialityController::class)->name('speciality.')->prefix('doctor/speciality')->group(function () {
        Route::get('/update/status/{id}/{status}', 'updateStatus')->name('speciality_status');
    });

    /** doctor department */
    Route::resource('doctor/department',DepartmentController::class)->except(['create','show']);
    Route::controller(DepartmentController::class)->name('department.')->prefix('doctor/department')->group(function () {
        Route::get('/update/status/{id}/{status}', 'updateStatus')->name('department_status');
    });

    /** Language  */
    Route::resource('language',LanguageController::class)->except(['create','show']);
    Route::controller(LanguageController::class)->name('language.')->prefix('language')->group(function () {
        Route::get('/update/status/{id}/{status}', 'updateStatus')->name('language_status');
    });

    /** Admin Localiztion */
    Route::controller(LocalizationController::class)->prefix('language')->name('language.')->group(function(){
        Route::get('/admin-language','adminLanguage')->name('admin_language');
    });

    /** Change Admin Language */
    Route::get('/change-admin-language/{code}',LanguageChangeController::class);

});