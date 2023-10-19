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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Game routes.
Route::post('create-new-game', [\App\Http\Controllers\Api\V1\CreateNewGame::class, 'store']);
Route::get('is-url-exist/{url}', [\App\Http\Controllers\Api\V1\CreateNewGame::class, 'show']);
Route::get('/guest-user', [\App\Http\Controllers\Api\V1\GuestController::class, 'index']);
Route::post('/store-guest-user', [\App\Http\Controllers\Api\V1\GuestController::class, 'store']);
Route::get('/player-in-game-status',[\App\Http\Controllers\Api\V1\PlayerInGameController::class, 'playerInGameStatus']) ;
Route::post('/join-game', [\App\Http\Controllers\Api\V1\PlayerInGameController::class, 'store']);

Route::get('/games', [\App\Http\Controllers\YadController::class, 'index']);
Route::put('/update-game`', [\App\Http\Controllers\YadController::class, 'updateGame']);
Route::get('/test', function(){
    event(new \App\Events\ExampleEvent('halaw'));
    return 'bra leray ?';
});
