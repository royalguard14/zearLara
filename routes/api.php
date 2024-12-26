<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;

/*
|---------------------------------------------------------------------------
| API Routes
|---------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Fetch modules for a specific role
Route::get('/role/{role}/modules', [ModuleController::class, 'getModulesForRole']);

// Save selected modules for a specific role
Route::post('/role/{role}/modules', [ModuleController::class, 'updateModulesForRole']);
