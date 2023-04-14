<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuoteController;

        Route::get('quotes',[QuoteController::class ,'index']);
        Route::post('quote/add',[QuoteController::class ,'store']);
        Route::post('quote/{id}/update',[QuoteController::class ,'update']);
        Route::get('quote/{id}/show',[QuoteController::class ,'show']);
        Route::delete('quote/{id}/delete',[QuoteController::class ,'destroy']);
