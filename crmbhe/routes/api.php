<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ApplicationController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    // Lead Routes
    Route::get('leads', [LeadController::class, 'leads']); 
    Route::post('store', [LeadController::class, 'store']);    
    Route::post('leads/assign', [LeadController::class, 'assignLead']);
    Route::patch('leads/{id}', [LeadController::class, 'updateLeadStatus']);

    // Application Routes
    Route::patch('applications/{id}', [ApplicationController::class, 'updateApplicationStatus']);
});


Route::get('test', function () {
    return response()->json(['message' => 'API is working!']);
});


