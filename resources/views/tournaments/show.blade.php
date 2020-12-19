@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <section class="topic"><h2 id="about"><a href="#about">#</a> {{ $tournament->name }}</h2> <p>Welcome to the {{ $tournament->name }} tournament!</p></section>
            <div class="nes-table-responsive">
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
                        {{-- {{ dd($player->score) }} --}}
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
</div>
@endsection
