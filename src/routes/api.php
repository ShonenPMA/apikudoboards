<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ProjectUserController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\TeamUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('editProfile', [AuthController::class, 'editProfile']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('project/indexFromAuthUser', [ProjectController::class, 'indexFromAuthUser']);
    Route::apiResource('project', ProjectController::class)->except(['show','index']);

    Route::prefix('projectUser')->group(function(){
        Route::post( '/', [ProjectUserController::class, 'store'])->middleware('onlyOwnerProject');
        Route::get('{project:id}', [ProjectUserController::class, 'indexFromProject'])->middleware('onlyOwnerProject');
        Route::delete( '{projectUser:id}', [ProjectUserController::class, 'destroy']);
    });

    Route::prefix('teamUser')->group(function(){
        Route::post( '/', [TeamUserController::class, 'store'])->middleware('onlyOwnerTeam');
    });
    
    
    
    Route::get('team/indexFromAuthUser', [TeamController::class, 'indexFromAuthUser']);
    Route::apiResource('team', TeamController::class)->except(['show','index'])
        ;
});
