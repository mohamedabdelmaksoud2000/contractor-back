<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1' ,'namspace'=>'Api'], function()
    {
        Route::post('register' ,[AuthController::class , 'register'] );
        Route::post('login' ,[AuthController::class , 'login'] );
    }
);

Route::group(['middleware'=>'auth:sanctum' ,'prefix'=>'v1' ,'namspace'=>'Api'], function()
    {

        // user Controller
        require 'API/user.php';
        // user campany
        require 'API/company.php';

    }

);
