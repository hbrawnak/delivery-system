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
/*Auth Middleware starts here*/
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

    /*Admin Middleware starts here*/
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
    Route::get('deliveries', [
        'uses' => 'AdminController@delivery',
        'as' => 'delivery'
    ]);
    Route::get('/{id}/status', [
        'uses' => 'AdminController@updateStatus',
        'as' => 'updateStatus'
    ]);
    Route::get('/{id}/progress', [
        'uses' => 'AdminController@inProgress',
        'as' => 'progress'
    ]);
    Route::get('/{id}/delivery', [
        'uses' => 'AdminController@delivered',
        'as' => 'delivered'
    ]);
    Route::get('/{id}/returned', [
        'uses' => 'AdminController@returned',
        'as' => 'returned'
    ]);
    Route::get('/logout', [
        'uses' => 'AdminController@logout',
        'as' => 'admin.logout'
    ]);

});
