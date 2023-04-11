<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\CompanyController;
    
        Route::get('company',[CompanyController::class ,'index']);
        Route::post('company/add_info',[CompanyController::class ,'store']);
        Route::post('company/{id}/update',[CompanyController::class ,'update']);
        Route::get('company/{id}/show',[CompanyController::class ,'show']);
        Route::delete('company/{id}/delete',[CompanyController::class ,'delete']);
