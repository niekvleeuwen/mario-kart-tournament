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

        $tournament->players = $player_ids;
        $tournament->save();

        return redirect('/tournaments/' . $tournament->id);
    }

    public function edit(Tournament $tournament)
    {
        return view('tournaments.edit', compact('tournament'));
    }

    public function update(Tournament $tournament)
    {

    }

    public function delete(Tournament $tournament)
    {
        $tournament->delete();
        return redirect('/tournaments');
    }
}
