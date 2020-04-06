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

Route::group([
  'namespace' => 'API\v1',
  'prefix' => 'v1',

  // 'middleware' => 'auth:api'
], function () {
  Route::post('register', 'AuthController@register');
  Route::post('login', 'AuthController@login'); 

  Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/events', 'EventController@store');
    Route::post('/events/list', 'EventController@show');

  });

  
  // Route::resource('/users', 'UserController', [
  //   'except' => ['show', 'create', 'store']
  // ]);                                                                          
}); 


// Route::prefix('v1')->group(function(){
//   Route::post('login', 'API\AuthController@login');
//   Route::post('register', 'Api\AuthController@register');

//   Route::group(['middleware' => 'auth:api'], function() {
//     Route::post('getUser', 'Api\AuthController@getUser');
//   });
// });