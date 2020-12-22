<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Player;
use Illuminate\Http\Request;

class TournamentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tournaments.index');
    }

    public function create()
    {
        return view('tournaments.create');
    }


    public function show(Tournament $tournament)
    {
        $players = Player::where('tournament_id', $tournament->id)->get();
        return view('tournaments.show', compact('tournament', 'players'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:tournaments',
            'players' => 'required',
            'rounds' => 'required|integer',
            'playersperround' => 'required|integer',
        ]);

        $players = explode("\r\n",$data['players']);

        $tournament = auth()->user()->tournaments()->create($data);

        $player_ids = [];
        foreach($players as $player)
        {
            $p = new Player;
            $p->tournament_id = $tournament->id;
            $p->name = $player;
            $p->score = array_fill(0, $tournament->rounds, 0);
            $p->save();
            array_push($player_ids, $p->id);
        }

        $tournament->schedule = $this->generateSchedule($player_ids, $tournament->rounds, $data["playersperround"]);
        $tournament->players = $player_ids;
        $tournament->rounds = count($tournament->schedule);
        $tournament->save();

        return redirect('/tournaments/' . $tournament->id);
    }

    public function edit(Tournament $tournament)
    {
        return view('tournaments.edit', compact('tournament'));
    }

    public function update(Tournament $tournament)
    {
        // get the players who are playing the current round
        $players = Player::whereIn('id', $tournament->schedule[$tournament->rounds_played])->get();
        return view('tournaments.update', compact('tournament', 'players'));
    }

    public function updatescores(Tournament $tournament)
    {
        $players = Player::whereIn('id', $tournament->schedule[$tournament->rounds_played])->get();
        $validation = [];
        foreach($players as $player)
        {
            $validation[strtolower($player->name)] = "required|integer";
        }

        $data = request()->validate($validation);

        foreach($players as $player)
        {
            $score = $player->score;
            $score[$tournament->rounds_played] = $data[strtolower($player->name)];
            $player->score = $score;
            $player->save();
        }
        $tournament->rounds_played += 1;
        $tournament->save();
        return redirect('/tournaments/' . $tournament->id);
    }

    public function delete(Tournament $tournament)
    {
        $tournament->delete();
        return redirect('/tournaments');
    }

    /* Private functions */

    private function generateSchedule($player_ids, $rounds, $number_of_players_per_round)
    {
        $schedule = [];
        // calculate number spots
        $spots = $rounds * $number_of_players_per_round;
        // calculate number of games each player plays
        $times = ($spots-($spots % count($player_ids)))/count($player_ids);
        $number_of_games_per_player = round($spots / count($player_ids));
        for($i = 0; $i < $number_of_games_per_player; $i++)
        {
            // number of rounds needed to let all players play 1 game
            $rounds_all_players = count($player_ids) / $number_of_players_per_round;
            $available_players = $player_ids;
            for($j = 0; $j < $rounds_all_players; $j++)
            {
                $round = [];
                for($k = 0; $k < $number_of_players_per_round; $k++)
                {
                    // if number of players is uneven, ignore the last player so you have one player per round less
                    if(!empty($available_players))
                    {
                        // take random player from available array
                        $rand = array_rand($available_players);
                        $id = $available_players[$rand];
                        // remove the player from the available players array
                        unset($available_players[$rand]);
                        // add the player to this round
                        array_push($round, $id);
                    }
                }
                array_push($schedule, $round);
            }
        }
        return $schedule;
    }
}
