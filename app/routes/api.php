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
$router->group([
    'prefix' => 'v1',
    // 'namespace' => 'v1',
     //'middleware' => ['auth'],
], function ($router) {
    $router->get('/user','API\POSTu@index');
    $router->get('/user/{id}','API\POSTu@show');
    $router->post('/user','API\POSTu@store');
    $router->put('/user/{id}','API\POSTu@update');
    $router->delete('/user/{id}','API\POSTu@destroy');

    $router->get('/employments','API\POSTel@index');
    $router->get('/employments/{id}','API\POSTel@show');
    $router->post('/employments','API\POSTel@store');
    $router->put('/employments/{id}','API\POSTel@update');
    $router->delete('/employments/{id}','API\POSTel@destroy');

    $router->get('/users','API\APIController@index');

});
