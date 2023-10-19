<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class YadController extends Controller
{
    //
    public function index(){
        $games = Game::all();
        return response([
            'games' => $games,
        ]);
    }

    public function updateGame(Request $request){
        $game = Game::where(['id' => $request->id])->first();
        $game->update([
            'hosted_by' => $request->hosted_by,
        ]);
        $game->save();
        return $game;
    }
}
