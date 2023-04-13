<?php

use App\Http\Controllers\Api\ProfessionController;
use Illuminate\Support\Facades\Route;

Route::get('professions' , [ProfessionController::class , 'index']);
Route::get('profession/{id}/show' , [ProfessionController::class , 'show']);
Route::post('profession/create' , [ProfessionController::class , 'store']);
Route::post('profession/{id}/update' , [ProfessionController::class , 'update']);
Route::delete('profession/{id}/delete' , [ProfessionControllerntroller::class , 'destroy']);
