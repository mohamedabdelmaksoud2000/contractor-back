<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

 Route::get('users',[UserController::class ,'index']);
 Route::post('user/create' , [UserController::class , 'store']);
 Route::get('user/{id}/show',[UserController::class ,'show']);
 Route::post('user/{id}/update',[UserController::class ,'update']);
 Route::delete('user/{id}/delete',[UserController::class ,'destroy']);
 Route::put('user/{id}/change_password',[UserController::class ,'change_password']);

 // Route::apiResource('users',UserController::class);
