<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AdminController;
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
	// Admine Route
Route::group(['prefix'=>'admin'],function(){
	//new ads
	Route::get('/new-ads','App\Http\Controllers\AdminController@new_ads')
	->name('new_ads');
	Route::put('/valide/{id}',  
	['as' => 'advertisement.valide',
	'uses' => 'App\Http\Controllers\AdvertisementController@valide']);
	//old ads
    Route::get('/edit-profile','App\Http\Controllers\AdminController@old_ads')
	->name('old_ads');
	Route::put('/supervise/{id}',  
	['as' => 'advertisement.masque',
	'uses' => 'App\Http\Controllers\AdvertisementController@masque']);	
	});
// Route::get('/supervise','App\Http\Controllers\AdminController@supervise')
// 	->name('supervise');
// Route::put('/supervise/{id}',  
// 	['as' => 'advertisement.valide',
// 	'uses' => 'App\Http\Controllers\AdvertisementController@valide']);
// Route::put('/supervise/{id}',  
// 	['as' => 'advertisement.masque',
// 	'uses' => 'App\Http\Controllers\AdvertisementController@masque']);

Route::resource('advertisement', AdvertisementController::class);

Auth::routes();
