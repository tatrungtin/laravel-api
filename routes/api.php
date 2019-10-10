<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'API\JwtController@register')->middleware('log');
Route::post('login', 'API\JwtController@login')->middleware('log');
Route::group(['middleware' => ['jwt.auth', 'role:api', 'log']], function () {
    Route::resource('users', 'API\UserController', ['except' => [ 'show' ]]);
    Route::resource('roles', 'API\RoleController', ['except' => [ 'show' ]]);
});
