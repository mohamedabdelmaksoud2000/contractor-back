<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('teams' , [TeamController::class , 'index']);
Route::get('team/{id}/show' , [TeamController::class , 'show']);
Route::post('team/create' , [TeamController::class , 'store']);
Route::post('team/{id}/updte' , [TeamController::class , 'update']);
Route::delete('team/{id}/delete' , [TeamController::class , 'delete']);


