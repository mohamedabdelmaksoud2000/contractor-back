<?php

use App\Http\Controllers\Api\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('items' , [ItemController::class , 'index']);
Route::get('item/{id}/show' , [ItemController::class , 'show']);
Route::post('item/create' , [ItemController::class , 'store']);
Route::post('item/{id}/update' , [ItemController::class , 'update']);
Route::delete('item/{id}/delete' , [ItemController::class , 'destroy']);


