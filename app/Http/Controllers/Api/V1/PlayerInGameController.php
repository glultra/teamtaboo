<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\PlayerJoinedGameEvent;
use App\Http\Controllers\Controller;
use App\Models\PlayerInGame;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerInGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $player = $request->user();
        $game = \App\Models\Game::where($request->game)->first();
        $player_in_game = \App\Models\PlayerInGame::create([
            'player_id' => $player->id,
            'game_id' => $game->id,
            'joined_as' => $request->name,
        ]);

        event(new PlayerJoinedGameEvent($game));

        return response([
            'player_in_game' => $player_in_game,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($playerInGameId)
    {
        //

        return $playerInGameId;
    }

    public function playerInGameStatus(Request $request)
    {
        //
        $player = $request->user();
        $game = \App\Models\Game::where(['url' => $request->game_url])->first();
        $playerInGame = \App\Models\PlayerInGame::where(['player_id' => $player->id])->where(['game_id' => $game->id])->first();
        $playersInGame = PlayerInGame::where(['game_id' => $game->id])->get();
        return response([
            'status' => $playerInGame ? true : false,
            'player_in_game' => $playerInGame,
            'players_in_game' => $playersInGame,
            'game' => $game,
            'player' => $player,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlayerInGame $playerInGame)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlayerInGame $playerInGame)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlayerInGame $playerInGame)
    {
        //
    }
}
