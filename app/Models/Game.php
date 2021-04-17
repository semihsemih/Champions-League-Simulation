<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['home_team', 'away_team', 'week', 'home_score', 'away_score'];

    public function initGame($home_id, $away_id, $week)
    {
        $game = Game::create([
            'home_team' => $home_id,
            'away_team' => $away_id,
            'week' => $week
        ]);

        $game->save();
    }

    public function homeTeam() {
        return $this->belongsTo(Team::class, 'home_team', 'id');
    }
    
    public function awayTeam() {
        return $this->belongsTo(Team::class, 'away_team', 'id');
    }
}
