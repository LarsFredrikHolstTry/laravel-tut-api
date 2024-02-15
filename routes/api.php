<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\StudentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'students'], function(){
    Route::get('/', [StudentController::class, 'index']);
    Route::post('/', [StudentController::class, 'store']);
    Route::get('/{id}', [StudentController::class, 'show']);
    Route::put('/{id}/edit', [StudentController::class, 'update']);
    Route::delete('/{id}', [StudentController::class, 'destroy']);
});