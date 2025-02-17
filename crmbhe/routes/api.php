<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// // Authentication Routes
// Route::post('login', [AuthController::class, 'login']);

// // Protected routes
// Route::middleware('jwt.auth')->group(function () {
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::get('user', [AuthController::class, 'getUser']);
    
//     // Lead Routes (Admin Only)
//     Route::resource('leads', LeadController::class);

//     // Assignments Routes (Admin Only)
//     Route::post('assign-lead/{lead}', [AssignmentController::class, 'assignLead']);

//     // Application Routes (Counselors)
//     Route::resource('applications', ApplicationController::class);
// });

Route::get('test', function () {
    return response()->json(['message' => 'API is working!']);
});



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(LeadController::class)->group(function () {
    Route::post('store', 'store');
}); 