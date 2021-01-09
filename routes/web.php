<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;

/*
|---------------------------------------------------------------------------------------------------------------------
|                                             Web Routes_
|---------------------------------------------------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|---------------------------------------------------------------------------------------------------------------------
|                                             Home Route_
|---------------------------------------------------------------------------------------------------------------------
*/

// Route directing to the Home Page_
    Route::get('/', 'App\Http\Controllers\MainController@Homepage')->name('homepage');

    /* 
        Route::get('/home', function() {
            return view('auth.login');
        });
    */

/*
|---------------------------------------------------------------------------------------------------------------------
|                                             Email verification Routes_
|---------------------------------------------------------------------------------------------------------------------
*/

// Route directing to Email verification view if Email IS NOT verified

/*
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware(['auth'])->name('verification.notice');
    */

// Route::middleware(['web'])->get('/', 'App\Http\Controllers\MainController@Homepage')->name('homepage');

/*
|---------------------------------------------------------------------------------------------------------------------
|                                             Login Route_
|---------------------------------------------------------------------------------------------------------------------
*/

// Route directing to the Login Page_
Route::get('/login', 'App\Http\Controllers\MainController@Login')->name('login');


/*
|---------------------------------------------------------------------------------------------------------------------
|                                             Registeration Routes
|---------------------------------------------------------------------------------------------------------------------
*/

Route::get('/register', 'App\Http\Controllers\MainController@register')->name('register');

Route::get('/seller/profile', 'App\Http\Controllers\MainController@sellerProfile')->name('seller-profile');
Route::get('/client/profile', 'App\Http\Controllers\MainController@clientProfile')->name('client-profile');


/*
|---------------------------------------------------------------------------------------------------------------------
|                                             Authentication Routes
|---------------------------------------------------------------------------------------------------------------------
*/

//Route_
// Route::post('login', 'Auth\AuthController@login')->name('login');
// Authentication...

/*
|---------------------------------------------------------------------------------------------------------------------
|                                             Admin CRUD Routes_
|---------------------------------------------------------------------------------------------------------------------
*/

//Route directing to the Administrator's dashboard_
    Route::get('/admin/crud', 'App\Http\Controllers\MainController@adminCrud')->name('admin-crud');
    Route::get('/admin/crud', 'App\Http\Controllers\MainController@adminCrud')->name('admin-crud');

/*
|---------------------------------------------------------------------------------------------------------------------
|                                             Users Profiles Routes_
|---------------------------------------------------------------------------------------------------------------------
*/


Route::get('search/{id}/{category_id}/{location_id}/{user_id}', 'App\Http\Controllers\MainController@cardPage');
Route::get('/search', 'App\Http\Controllers\MainController@search')->name('search');


/*
|---------------------------------------------------------------------------------------------------------------------
|                                             Search Routes_
|---------------------------------------------------------------------------------------------------------------------
*/

// Route directing to the selected card from Search Page_
    Route::get('search/{id}/{category_id}/{location_id}/{user_id}', 'App\Http\Controllers\MainController@cardPage');
    
// Route directing to the Search Page_
    Route::get('/search', 'App\Http\Controllers\MainController@search')->name('search');

/*
|---------------------------------------------------------------------------------------------------------------------
|                                             About Routes
|---------------------------------------------------------------------------------------------------------------------
*/

// Route directing to the About Page_
Route::get('/About', 'App\Http\Controllers\MainController@About')->name('About');

/*
|---------------------------------------------------------------------------------------------------------------------
|                                             About Routes
|---------------------------------------------------------------------------------------------------------------------
*/

Route::get('/reset_password', 'App\Http\Controllers\MainController@resetPassW');

Route::post('send-token', 'App\Http\Controllers\MainController@sendToken');
Route::post('validate-token', 'App\Http\Controllers\MainController@validateToken');
Route::post('reset-password', 'App\Http\Controllers\MainController@resetPassword');
Route::get('send-reservation/{id}/{email}/', 'App\Http\Controllers\MainController@sendReservation');
