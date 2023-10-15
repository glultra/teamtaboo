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
Route::post('/player-in-game/{host_token}', function (Request $request) {
    $host_token = $request->host_token;
    $game = \App\Models\Game::where(['host_token' => $host_token])->get();
    return $game;
});
Route::post('/join-game', function (Request $request) {
    $player = \App\Models\GuestUser::where(['token' => $request->token])->first();
    $game = \App\Models\Game::where($request->game)->first();
    $player_in_game = \App\Models\PlayerInGame::create([
        'player_id' => $player->id,
        'game_id' => $game->id
    ]);
    return response([
        'player_in_game' => $player_in_game,
    ]);
});

