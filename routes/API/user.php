<?php 

Route::post('logout' ,[AuthController::class , 'logout'])->middleware('auth:sanctum');
Route::get('users',[UserController::class ,'index']);
Route::get('user/{id}/show',[UserController::class ,'show']);
Route::put('user/{id}/update',[UserController::class ,'update']);
Route::delete('user/{id}/delete',[UserController::class ,'delete']);
Route::put('user/{id}/change_password',[UserController::class ,'change_password']);