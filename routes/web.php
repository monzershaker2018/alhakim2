<?php

use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes(['register' => false]);

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 Route::get('/', function () {
     return view('auth.login');

 });


// dashboard routes
Route::prefix('dashboard')->middleware('auth')->group(function(){


Route::get('/index', 'App\Http\Controllers\HomeController@indexed');

Route::get('/change-password', 'App\Http\Controllers\HomeController@change_password');


//halaqats routes
Route::resource('halaqats', App\Http\Controllers\HalaqaController::class);

//users routes
Route::resource('users', App\Http\Controllers\UserController::class);

//admins routes
Route::resource('admins', App\Http\Controllers\AdminCon::class);

//students routes
Route::resource('students', App\Http\Controllers\StudentController::class);

//tickects routes
Route::resource('expenses', App\Http\Controllers\ExpensesController::class);

//airpors routes
Route::resource('donations', App\Http\Controllers\DonationController::class);
});


// dashboard routes
 Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

