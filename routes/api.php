<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//return $request->user();
//});
Route::group(['namespace'=>'Api','middleware' =>'checkLang'],function(){
    Route::group(['prefix'=>'properity'],function(){
        Route::post('index', 'ProperityController@index');
        Route::post('detail', 'ProperityController@ProperityDetails');
    });
    Route::post('settings', 'SettingsController@index');
});

Route::prefix('admin')->group(function () {
    Route::post('admin-login', [App\Http\Controllers\Api\AuthController::class,'login']);

    Route::middleware('auth:admin-api')->group(function () {



        // Route::post('logout', 'logout');
        // Route::post('me', 'me');
    });

});
include('api/auth.php');

