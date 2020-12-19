@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <section class="topic"><h2 id="about"><a href="#about">#</a>Tournaments</h2> <p>NES.css is NES-style (8bit-like) CSS Framework.</p></section>
            <a href="{{ route('tournaments.create') }}" type="button" class="nes-btn is-primary">Start a new Tournament</a>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-md-8">
            <div class="nes-table-responsive">
                <table class="nes-table is-bordered is-centered">
                  <thead>
                    <tr>
                      <th>Tournaments</th>
                      <th>Rounds player</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach (auth()->user()->tournaments as $tournament)
                      <tr>
                        <td><a href="/tournaments/{{ $tournament->id }}">{{ $tournament->name }}</a></td>
                        <td>x / {{ $tournament->rounds }}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
@endsection
