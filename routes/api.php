<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'UserAuthController@register');
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', 'UserAuthController@login');
    Route::post('logout', 'UserAuthController@logout');
    Route::post('refresh', 'UserAuthController@refresh');
    Route::post('me', 'UserAuthController@me');
});
Route::group(['prefix' => 'user', 'middleware' => 'api',], function () use ($router) {
    $router->resources([
        'order'  => 'OrderController'
    ]);
});
