@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a href="{{ action('TriosController@index') }}" class="btn btn-big btn--home btn--login text-uppercase">Trios</a>
            <a href="{{ action('StatsController@index') }}" class="btn btn-big btn-success btn--home text-uppercase">Statistics</a>
        </div>
    </div>
@endsection