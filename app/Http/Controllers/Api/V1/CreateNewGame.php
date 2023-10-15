<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GuestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateNewGame extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new game URL.
        do {
            $gameUrl = Str::random(8);
        } while (Game::where('url', $gameUrl)->exists());
        $token = session()->get('_token');
        $game = Game::create([
            'url' => $gameUrl,
            'hosted_by' => $request->username,
            'host_token' => $token
        ]);

        return response([
            'url' => $gameUrl,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $url)
    {
        $game = Game::where(['url' => $url])->get();
        if(!count($game)){
            throw new \Exception('Game is not exist.');
        }

        return response([
            'game' => $game[0],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
