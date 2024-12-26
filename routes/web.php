<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard/developer', [DashboardController::class, 'developer'])->name('developer.dashboard');
Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('user.dashboard');



Route::prefix('modules')->name('modules.')->middleware(['auth', 'checkRole:Developer'])->group(function () {
    Route::get('/', [ModuleController::class, 'index'])->name('index');
    Route::post('store', [ModuleController::class, 'store'])->name('store');  
    Route::put('{module}', [ModuleController::class, 'update'])->name('update');  
    Route::delete('{module}', [ModuleController::class, 'destroy'])->name('destroy'); 
});

Route::prefix('users')->name('users.')->middleware(['auth', 'checkRole:Developer'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');  
    Route::post('store', [UserController::class, 'store'])->name('store');  
    Route::put('{user}', [UserController::class, 'update'])->name('update');  
    Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');  
});

Route::prefix('settings')->name('settings.')->middleware(['auth', 'checkRole:Developer'])->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('index');
    Route::post('/store', [SettingsController::class, 'store'])->name('store');  
    Route::put('/{setting}', [SettingsController::class, 'update'])->name('update');  
    Route::delete('/{setting}', [SettingsController::class, 'destroy'])->name('destroy'); 
});




Route::prefix('roles')->name('roles.')->middleware(['auth', 'checkRole:Developer'])->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');  
    Route::post('store', [RoleController::class, 'store'])->name('store');  
    Route::put('{role}', [RoleController::class, 'update'])->name('update');  
    Route::delete('{role}', [RoleController::class, 'destroy'])->name('destroy'); 
});

Route::prefix('profiles')->name('profiles.')->middleware(['auth'])->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');  
    Route::put('{user}', [ProfileController::class, 'update'])->name('update');
    Route::put('/{user}/picture', [ProfileController::class, 'updatePicture'])->name('updatePicture');

    Route::put('/{user}/account', [ProfileController::class, 'updateAccount'])->name('updateAccount');
});



