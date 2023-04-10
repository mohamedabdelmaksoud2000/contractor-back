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
        Route::post('logout' ,[AuthController::class , 'logout'])->middleware('auth:sanctum');

        // user Controller

        Route::get('users',[UserController::class ,'index']);
        Route::get('user/{id}/show',[UserController::class ,'show']);
        Route::put('user/{id}/update',[UserController::class ,'update']);
        Route::delete('user/{id}/delete',[UserController::class ,'delete']);
        Route::put('user/{id}/change_password',[UserController::class ,'change_password']);
        
        // Company Controller
        Route::get('company',[CompanyController::class ,'index']);
        Route::post('company/add_info',[CompanyController::class ,'store']);
        Route::put('company/{id}/update',[CompanyController::class ,'update']);
        Route::get('company/{id}/show',[CompanyController::class ,'show']);
        Route::delete('company/{id}/delete',[CompanyController::class ,'delete']);
        
    }

);
