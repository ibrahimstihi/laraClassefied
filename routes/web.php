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


    Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'App\Http\Controllers\UserController@edit']);
    Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'App\Http\Controllers\UserController@update']);


Route::resource('advertisement', AdvertisementController::class);

Auth::routes();
