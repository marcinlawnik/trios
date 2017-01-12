@extends('layouts.app')

@section('content')
            <div class="jumbotron">
                <p class="center-block text-center">
                    Trios is a simple exercise to test your english skills:<br>
                    You should put in a single word that fits in all three sentences.<br>
                    Have fun!
                </p>
                <a class="btn btn-lg btn-success center-block" href="{{ action('SolveController@getRandom') }}">
                    Start solving!
                </a>
            </div>
@endsection
