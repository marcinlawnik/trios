@extends('layouts.app')

@section('content')
            <div class="jumbotron">
                <a class="btn btn-lg btn-success center-block" href="{{ action('SolveController@getRandom') }}">
                    Start solving!
                </a>
            </div>
@endsection
