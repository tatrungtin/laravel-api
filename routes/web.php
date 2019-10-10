<?php

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
    return view('welcome');
});

Auth::routes();


Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'role']], function() {
	Route::get('/', 'HomeController@index')->name('home');
	Route::resource('users', 'Admin\UserController', ['except' => [ 'show' ]]);
	Route::resource('roles', 'Admin\RoleController', ['except' => [ 'show' ]]);
    Route::get('change-password', 'Admin\UserController@getChangePassword')->name('getChangePassword');
    Route::post('change-password', 'Admin\UserController@postChangePassword')->name('postChangePassword');
});

/*
 * Route for testing
 */
Route::get('/test/user', 'Admin\TestController@user');
Route::post('/test/user', 'Admin\TestController@user');
Route::resource('/test', 'Admin\TestController');
