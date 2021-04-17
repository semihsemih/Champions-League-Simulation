<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class Team extends Model
{
    use HasFactory;

    public function homeMatches()
    {
        return $this->hasMany(Game::class, "home_team", "id");
    }

    public function awayMatches()
    {
        return $this->hasMany(Game::class, "away_team", "id");
    }

    public function countPlayedGames() {
        $asHome = $this->homeMatches()->whereNotNull('home_score')->count();
        $asAway = $this->awayMatches()->whereNotNull('away_score')->count();
        $total = $asHome + $asAway;
        return $total;
    }

    public function countWinMatches()
    {
        $count = 0;
        $homesMatches = $this->homeMatches;
        foreach($homesMatches as $match) {
                if ($match->home_score > $match->away_score) {
                    $count++;
                }
        }

        $awayMatches = $this->awayMatches;
        foreach($awayMatches as $match) {
                if ($match->home_score < $match->away_score) {
                    $count++;
                }
        }

        //dd($count);
        return $count;
    }

    public function countDrawMatches() {
        $count = 0;
        $homesMatches = $this->homeMatches;
        foreach($homesMatches as $match) {
            if ($match->home_score !== null && $match->away_score !== null) {
                if ($match->home_score == $match->away_score) {
                    $count++;
                }
            }
        }

        $awayMatches = $this->awayMatches;
        foreach($awayMatches as $match) {
            if ($match->home_score !== null && $match->away_score !== null) {
                if ($match->home_score == $match->away_score) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function countLosedMatches() {
        $count = 0;
        $homesMatches = $this->homeMatches;
        foreach($homesMatches as $match) {
            if ($match->home_score !== null && $match->away_score !== null) {
                if ($match->home_score < $match->away_score) {
                    $count++;
                }
            }
        }

        $awayMatches = $this->awayMatches;
        foreach($awayMatches as $match) {
            if ($match->home_score !== null && $match->away_score !== null) {
                if ($match->home_score > $match->away_score) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function getPoints() {
        $win = $this->countWinMatches();
        $draw = $this->countDrawMatches();

        $points = ($win*3) + ($draw*1);
        return $points; 
    }

    public function getGoalDifference() {
        $total= 0;
        $homeMatches = $this->homeMatches;
        foreach ($homeMatches as $match) {
            if ($match->home_score !== null && $match->away_score !== null) {
                $total += $match->home_score - $match->away_score;
            }
        }

        $awayMatches = $this->awayMatches;
        foreach ($awayMatches as $match) {
            if ($match->home_score !== null && $match->away_score !== null) {
                $total += $match->away_score - $match->home_score;
            }
        }

        return $total;
    }

    
}
