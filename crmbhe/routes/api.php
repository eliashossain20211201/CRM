<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AssignmentController;
use Illuminate\Support\Facades\Log;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    // Lead Routes
    Route::get('leads', [LeadController::class, 'leads']);
    Route::get('unassignedleads', [LeadController::class, 'unassignedLeads']);     
    Route::get('counselors', [AuthController::class, 'counselors']); 


    Route::post('store', [LeadController::class, 'store']);
    Route::post('assignlead', [AssignmentController::class, 'assignLead']);
    
  //  Route::post('leads/assign', [LeadController::class, 'assignLead']);
    Route::patch('leads/{id}', [LeadController::class, 'updateLeadStatus']);

    // Application Routes
    Route::patch('applications/{id}', [ApplicationController::class, 'updateApplicationStatus']);
});


Route::get('test', function () {
    return response()->json(['message' => 'API is working!']);
});


