<?php

use App\Http\Controllers\LeagueController;
use Illuminate\Support\Facades\Route;
use App\Models\Team;
use App\Models\Game;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/selam', function () {
    dd(Team::find(1)->awayMatches);
});
Route::get('/selam2',  [LeagueController::class, 'initFixture']);
Route::get('/selam3',  function() {
    $games = Game::with('homeTeam', 'awayTeam')->get();
    dump($games);
});