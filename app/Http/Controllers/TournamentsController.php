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
        $tournament = auth()->user()->tournaments()->create(request()->validate([
            'name' => 'required|unique:tournaments|',
            'players' => 'required|integer',
            'rounds' => 'required|integer',
        ]));

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
