@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <section class="topic">
                        <h2 id="about">
                            <a href="#about">#</a> {{ $tournament->name }}
                        </h2>
                        <p>Rounds played: {{ $tournament->rounds_played }} / {{ $tournament->rounds }}</p>
                    </section>
                </div>
                <div class="col-md-8">
                    <progress class="nes-progress is-pattern" value="{{ $tournament->rounds_played }}" max="{{ $tournament->rounds }}"></progress>
                </div>
            </div>
            <div class="nes-table-responsive pt-3">
                <table class="nes-table is-bordered">
                  <thead>
                    <tr>
                      <th>Players</th>
                      @for ($i = 1; $i <= $tournament->rounds; $i++)
                        <th>Round {{ $i }}</th>
                      @endfor
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($players as $player)
                      <tr>
                        <td>{{ $player->name }}</td>
                        @foreach ($player->score as $score)
                            <td>{{ $score }}</td>
                        @endforeach
                        <td>{{ array_sum($player->score) }}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
        </div>
    </div>
    @if($tournament->rounds_played < $tournament->rounds)
    <div class="row justify-content-center pt-3">
        <div class="col-md-12">
            <div class="lists">
                <ul class="nes-list is-disc">
                    @foreach ($tournament->schedule as $round)
                        <li>
                            @if ($loop->iteration <= $tournament->rounds_played)
                                <span class="nes-text is-disabled">
                            @endif
                            Round {{ $loop->iteration }}:
                            @foreach ($round as $playerid)
                                {{ App\Models\Player::find($playerid)->name }}
                                @if($loop->remaining > 0)
                                    vs.
                                @endif
                            @endforeach
                            @if ($loop->iteration <= $tournament->rounds_played)
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center pt-3">
        <div class="col-md-12">
                <a href="{{route('tournaments.update', ['tournament' => $tournament->id]) }}" type="button" class="nes-btn is-primary">Enter scores</a>
        </div>
    </div>
    @else
    <div class="row justify-content-center pt-3">
        <div class="col-md-12">
            <p>Finale time!</p>
        </div>
    </div>
    @endif
</div>
@endsection
