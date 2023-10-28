<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// private routes
Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('create-new-game', [\App\Http\Controllers\Api\V1\CreateNewGame::class, 'store']);
    Route::get('is-url-exist/{url}', [\App\Http\Controllers\Api\V1\CreateNewGame::class, 'show']);
    Route::get('/guest-user', [\App\Http\Controllers\Api\V1\GuestController::class, 'index']);
    Route::get('/player-in-game-status',[\App\Http\Controllers\Api\V1\PlayerInGameController::class, 'playerInGameStatus']) ;
    Route::post('/join-game', [\App\Http\Controllers\Api\V1\PlayerInGameController::class, 'store']);
});

// public routes
Route::post('/store-guest-user', [\App\Http\Controllers\Api\V1\GuestController::class, 'store']);

Route::get('/test', function(Request $request){
    event(new \App\Events\ExampleEvent('halaw'));
    return $request->user();
});
