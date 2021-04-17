<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Game;

class LeagueController extends Controller
{
    public function initFixture()
    {
        $games = Game::all();
        foreach($games as $game) {
            $game->delete();
        }

        $teams = Team::get(['id', 'name'])->toArray();
        $teamCount = count($teams);
        $fixedTeam = array_shift($teams);
        $g = new Game();
        
        for ($i=1; $i < $teamCount ; $i++) { 
            $g->initGame($fixedTeam["id"], $teams[0]["id"],$i);

            for ($j=1; $j < $teamCount/2; $j++) { 
                $g->initGame($teams[$j]["id"], $teams[$teamCount-$j-1]["id"], $i);
            }   
        
            array_push($teams, array_shift($teams));
        }

        for ($i=1; $i < $teamCount; $i++) { 
            $g->initGame($teams[0]["id"], $fixedTeam["id"], $i+$teamCount-1);

            for ($j=1; $j <$teamCount/2 ; $j++) { 
                $g->initGame($teams[$teamCount-$j-1]["id"], $teams[$j]["id"], $i+$teamCount-1);
            }

            array_push($teams, array_shift($teams));
        }

        $games = Game::with('homeTeam', 'awayTeam')->get();
        $teams = Team::all();
        $teams_result = [];
        
        for ($i=0; $i < $teams->count() ; $i++) { 
            $teamInfo = [
                'name' => $teams[$i]['name'],
                'played_games' => $teams[$i]->countPlayedGames(),
                'wins' => $teams[$i]->countWinMatches(),
                'loses' => $teams[$i]->countLosedMatches(),
                'draws' => $teams[$i]->countDrawMatches(),
                'gd' => $teams[$i]->getGoalDifference(),
                'points' => $teams[$i]->getPoints(),
            ];

            array_push($teams_result, $teamInfo);
        }        

        return response()->json(['games' =>$games,'teams' => $teams_result, 'week' => 0 ]);
    }

    public function nextWeek(Request $request)
    {
        
        $week = (int)$request->get('week');
         $match1 = (($week + 1) * 2) - 2;
         $match2 = (($week + 1) * 2) - 1;

         $games = Game::all();
         $games_collection = collect($games);
         $match1_info = $games_collection->get($match1);
         $match2_info = $games_collection->get($match2);

        $match = Game::find($match1_info["id"]);
        $match->home_score = rand(0, 5);
        $match->away_score = rand(0, 5);
        $match->save();

        $match = Game::find($match2_info["id"]);
        $match->home_score = rand(0, 5);
        $match->save();

        $match = Game::find($match2_info["id"]);
        $match->away_score = rand(0, 5);
        $match->save();

        $games = Game::with('homeTeam', 'awayTeam')->get();

        $teams = Team::all();
        $teams_result = [];
        
        for ($i=0; $i < $teams->count() ; $i++) { 
            $teamInfo = [
                'name' => $teams[$i]['name'],
                'played_games' => $teams[$i]->countPlayedGames(),
                'wins' => $teams[$i]->countWinMatches(),
                'loses' => $teams[$i]->countLosedMatches(),
                'draws' => $teams[$i]->countDrawMatches(),
                'gd' => $teams[$i]->getGoalDifference(),
                'points' => $teams[$i]->getPoints(),
            ];

            array_push($teams_result, $teamInfo);
        } 

        return response()->json(['games' =>$games,'teams' => $teams_result ]);
    }

    public function resetSession()
    {
        $games = Game::all();
        foreach($games as $game) {
            $game->delete();
        }

        $teams = Team::get(['id', 'name'])->toArray();
        $teamCount = count($teams);
        $fixedTeam = array_shift($teams);
        $g = new Game();
        
        for ($i=1; $i < $teamCount ; $i++) { 
            $g->initGame($fixedTeam["id"], $teams[0]["id"],$i);

            for ($j=1; $j < $teamCount/2; $j++) { 
                $g->initGame($teams[$j]["id"], $teams[$teamCount-$j-1]["id"], $i);
            }   
        
            array_push($teams, array_shift($teams));
        }

        for ($i=1; $i < $teamCount; $i++) { 
            $g->initGame($teams[0]["id"], $fixedTeam["id"], $i+$teamCount-1);

            for ($j=1; $j <$teamCount/2 ; $j++) { 
                $g->initGame($teams[$teamCount-$j-1]["id"], $teams[$j]["id"], $i+$teamCount-1);
            }

            array_push($teams, array_shift($teams));
        }

        $games = Game::with('homeTeam', 'awayTeam')->get();
        $teams = Team::all();
        $teams_result = [];
        
        for ($i=0; $i < $teams->count() ; $i++) { 
            $teamInfo = [
                'name' => $teams[$i]['name'],
                'played_games' => $teams[$i]->countPlayedGames(),
                'wins' => $teams[$i]->countWinMatches(),
                'loses' => $teams[$i]->countLosedMatches(),
                'draws' => $teams[$i]->countDrawMatches(),
                'gd' => $teams[$i]->getGoalDifference(),
                'points' => $teams[$i]->getPoints(),
            ];

            array_push($teams_result, $teamInfo);
        }        

        return response()->json(['games' =>$games,'teams' => $teams_result, 'week' => 0 ]);

        
    }

    public function playAll()
    {
        $games = Game::all();
        $games_collection = collect($games);
        foreach ($games_collection as $game) {
            $g = Game::find($game["id"]);
            $g->home_score = rand(0, 5);
            $g->away_score = rand(0, 5);
            $g->save();
        }

        $games = Game::with('homeTeam', 'awayTeam')->get();
        $teams = Team::all();
        $teams_result = [];
        
        for ($i=0; $i < $teams->count() ; $i++) { 
            $teamInfo = [
                'name' => $teams[$i]['name'],
                'played_games' => $teams[$i]->countPlayedGames(),
                'wins' => $teams[$i]->countWinMatches(),
                'loses' => $teams[$i]->countLosedMatches(),
                'draws' => $teams[$i]->countDrawMatches(),
                'gd' => $teams[$i]->getGoalDifference(),
                'points' => $teams[$i]->getPoints(),
            ];

            array_push($teams_result, $teamInfo);
        }        

        return response()->json(['games' =>$games,'teams' => $teams_result, 'week' => 6 ]);
    }
}
