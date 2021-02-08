<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});


Route::group([
    'middleware' => ['auth', 'site'],
    'as'=>'menu.',
], function () {
    Route::get('/', ['as'=>'dashboard', 'uses'=>'App\Http\Controllers\SummaryController@index']);
    Route::match(['get', 'post'], '/page/{id?}', ['as'=>'page', 'uses'=>'App\Http\Controllers\ProductController@create']);
    Route::get('/category/{id}', ['as'=>'category', 'uses'=>'App\Http\Controllers\CategoryController@index']);
    Route::post('/select', ['as'=>'select', 'uses'=>'App\Http\Controllers\CategoryController@select']);
    Route::any('/users', ['as'=>'users', 'uses'=>'App\Http\Controllers\UserController@index']);
    Route::post('/change-count', ['as'=>'change_count', 'uses'=>'App\Http\Controllers\ProductController@changeCount']);
    Route::post('/product/delete', ['as'=>'delete', 'uses'=>'App\Http\Controllers\ProductController@delete']);

    Route::post('/add-category', ['as'=>'add_category', 'uses'=>'App\Http\Controllers\CategoryController@addCategory']);
});

Auth::routes();
