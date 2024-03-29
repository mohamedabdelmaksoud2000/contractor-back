<?php
use App\Http\Controllers\Api\ClientController;

        Route::get('clients',[ClientController::class ,'index']);
        Route::post('client/add',[ClientController::class ,'store']);
        Route::put('client/{id}/update',[ClientController::class ,'update']);
        Route::get('client/show/{id}',[ClientController::class ,'show']);
        Route::delete('client/delete/{id}',[ClientController::class ,'destroy']);
