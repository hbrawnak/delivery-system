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

Route::get('/', [
    'uses' => 'UserController@index',
    'as' => 'login'
]);
Route::post('/login', [
    'uses' => 'UserController@login',
    'as' => 'user.login'
]);
Route::get('/dashboard', [
    'uses' => 'UserController@dashboard',
    'as' => 'dashboard'
]);
Route::get('/deliveries', [
    'uses' => 'UserController@deliveries',
    'as' => 'deliveries'
]);
Route::get('/delivery/create', [
    'uses' => 'UserController@deliveryCreate',
    'as' => 'deliveryCreate'
]);
Route::post('/delivery/post', [
    'uses' => 'UserController@postNewDelivery',
    'as' => 'postNewDelivery'
]);
Route::get('/logout', [
    'uses' => 'UserController@logout',
    'as' => 'user.logout'
]);


Route::prefix('/a/admin')->group(function () {

    Route::get('/', [
        'uses' => 'AdminController@index',
        'as' => 'admin.login'
    ]);
    Route::post('/login', [
        'uses' => 'AdminController@login',
        'as' => 'post.login'
    ]);

    Route::get('/dashboard', [
        'uses' => 'AdminController@dashboard',
        'as' => 'admin.dashboard'
    ]);
    Route::get('/users', [
        'uses' => 'AdminController@users',
        'as' => 'admin.users'
    ]);
    Route::get('user/create', [
        'uses' => 'AdminController@createUser',
        'as' => 'user.create'
    ]);
    Route::post('/post/user', [
        'uses' => 'AdminController@postNewUser',
        'as' => 'postNewUser'
    ]);
    Route::get('delivery', [
        'uses' => 'AdminController@delivery',
        'as' => 'delivery'
    ]);
    Route::get('/status/{id}', [
        'uses' => 'AdminController@updateStatus',
        'as' => 'updateStatus'
    ]);
    Route::get('/logout', [
        'uses' => 'AdminController@logout',
        'as' => 'admin.logout'
    ]);

});
