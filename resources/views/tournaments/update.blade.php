@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <section class="showcase">
                <section class="nes-container with-title">
                    <h3 class="title">{{ $tournament->name }}</h3>
                    @if($tournament->rounds_played < $tournament->rounds)
                        Fill in the scores of round {{ $tournament->rounds_played+1}}
                    @else
                        <p>All rounds are played.</p>
                        <a class="nes-btn" href="{{route('tournaments.show', ['tournament' => $tournament->id]) }}">Go back</a>
                    @endif
                </section>
            </section>
        </div>
    </div>
    @if($tournament->rounds_played < $tournament->rounds)
    <div class="row justify-content-center pt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="/tournaments/{{ $tournament->id }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')

                        @foreach ($players as $player)
                            {{-- {{ dd($player) }} --}}
                            <div class="form-group row">
                                <label for="{{ strtolower($player->name) }}" class="col-md-4 col-form-label text-md-right">{{ $player->name }}</label>

                                <div class="col-md-6">
                                    <input id="{{ strtolower($player->name) }}" type="number" class="nes-input form-control @error(strtolower($player->name)) is-invalid @enderror" name="{{ strtolower($player->name) }}" value="{{ old(strtolower($player->name)) }}" required>

                                    @error(strtolower($player->name))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
