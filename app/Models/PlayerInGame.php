<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerInGame extends Model
{
    use HasFactory;
    protected $table = 'player_in_game';

    protected $fillable = [
        'game_id',
        'player_id',
        'joined_as'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function player()
    {
        return $this->belongsTo(GuestUser::class, 'player_id');
    }

}
