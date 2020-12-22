@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <section class="showcase">
                <section class="nes-container with-title">
                    <h3 class="title">Tournament</h3>
                    A tournament consists of two parts. In the first part the players play against each other in a chosen number of rounds. At the end of the rounds the obtained points are counted and the 4
                    players with the most points will proceed to the finals.
                </section>
            </section>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New tournament</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tournaments.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="nes-input form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="players"  class="col-md-4 col-form-label text-md-right">Players</label>
                            <div class="col-md-6">
                                <textarea class="form-control nes-textarea" id="players" name="players" rows="8" required>{{ old('players') }}</textarea>

                                @error('players')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rounds" class="col-md-4 col-form-label text-md-right">Number of rounds</label>
                            <div class="col-md-6">
                                <div class="nes-select">
                                    <select required id="rounds" name="rounds">
                                        <option value="2">2</option>
                                        <option value="4" selected>4</option>
                                        <option value="6">6</option>
                                        <option value="8">8</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                @error('rounds')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="playersperround" class="col-md-4 col-form-label text-md-right">Number of players per round</label>

                            <div class="col-md-6">
                                <input id="playersperround" type="number" class="nes-input form-control @error('playersperround') is-invalid @enderror" name="playersperround" value="{{ old('playersperround') }}" required>

                                @error('playersperround')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
</div>
@endsection
