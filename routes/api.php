<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Game;
use App\Http\Controllers\LeagueController;
use App\Models\Team;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get("/get-fixtures", function() {
    $games = Game::with('homeTeam', 'awayTeam')->get();
    return response()->json($games);
});

Route::get("/create-fixtures", [LeagueController::class, 'initFixture']);
Route::get("/next-week", [LeagueController::class, 'nextWeek']);
Route::get("/play-all", [LeagueController::class, 'playAll']);
Route::get("/reset-session", [LeagueController::class, 'resetSession']);
