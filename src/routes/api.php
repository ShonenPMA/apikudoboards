<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KudoboardController;
use App\Http\Controllers\API\KudoController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ProjectUserController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\TeamUserController;
use App\Http\Controllers\API\UserController;
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
        Route::get('/currentUser', [AuthController::class, 'currentUser']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('kudo')->group(function(){
        
        Route::post('/', [KudoController::class, 'store'])
            ->middleware(['receiverCanNotBeSender', 'kudoboardShouldBelongSenderOrReceiver']);
            Route::get('indexFromKudoboard/{kudoboards:id}', [KudoController::class, 'indexFromKudoboard'])
            ->middleware(['kudoboardShouldBelongAuthUser']);
        Route::match(['put','patch'],'{kudo:id}', [KudoController::class, 'update'])
            ->middleware(['onlySender']);
        Route::delete('{kudo:id}', [KudoController::class, 'destroy'])
            ->middleware(['onlySender']);

    });
    
    Route::get('kudoboards', [KudoboardController::class, 'index']);
    

    Route::get('project/indexFromAuthUser', [ProjectController::class, 'indexFromAuthUser']);
    Route::apiResource('project', ProjectController::class)->except(['show','index']);

    Route::prefix('projectUser')->group(function(){
        Route::post( '/', [ProjectUserController::class, 'store'])->middleware('onlyOwnerProject');
        Route::get('{project:id}', [ProjectUserController::class, 'indexFromProject'])->middleware('onlyOwnerProject');
        Route::delete( '{projectUser:id}', [ProjectUserController::class, 'destroy']);
    });

    Route::prefix('teamUser')->group(function(){
        Route::post( '/', [TeamUserController::class, 'store'])->middleware('onlyOwnerTeam');
        Route::get('{team:id}', [TeamUserController::class, 'indexFromTeam'])->middleware('onlyOwnerTeam');
        Route::delete( '{teamUser:id}', [TeamUserController::class, 'destroy']);
    });
    
    Route::get('team/indexFromAuthUser', [TeamController::class, 'indexFromAuthUser']);
    Route::apiResource('team', TeamController::class)->except(['show','index'])
        ;

    Route::get('user/indexExceptAuth', [UserController::class, 'indexExceptAuth']);
    Route::get('user/indexFromProject/{project:id}', [UserController::class, 'indexFromProject']);
    Route::get('user/indexFromTeam/{team:id}', [UserController::class, 'indexFromTeam']);
});
