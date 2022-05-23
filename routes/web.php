<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\UserController;
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
    return redirect('advertisement');
});

Route::get('advertisement/admin', [AdvertisementController::class, 'admin'])
    ->name('advertisement.admin');

Route::get('advertisement/category/{id}', [AdvertisementController::class, 'adsByCategory'])
    ->name('advertisement.adsByCategory');


    // Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'App\Http\Controllers\UserController@edit']);
    // Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'App\Http\Controllers\UserController@update']);
	Route::group(['prefix'=>'profile'],function(){
		Route::get('/dashboard','App\Http\Controllers\UserController@dashboard')->name('dashboard');

		Route::get('/edit-profile','App\Http\Controllers\UserController@edit_profile')->name('edit_profile');
        Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'App\Http\Controllers\UserController@update']);
		// Route::put('/edit-profile','App\Http\Controllers\UserController@update_profile')->name('update_profile');

		Route::get('/change-password','App\Http\Controllers\UserController@change_password')->name('change_password');
		// Route::post('change-password', 'App\Http\Controllers\UserController@update_password')->name('change.password');
		Route::patch('users/{user}/update_password',  ['as' => 'users.update_password', 'uses' => 'App\Http\Controllers\UserController@update_password']);
		
		// Route::post('/update-password','App\Http\Controllers\UserController@update_password')->name('update_password');	
	});

Route::resource('advertisement', AdvertisementController::class);

Auth::routes();
