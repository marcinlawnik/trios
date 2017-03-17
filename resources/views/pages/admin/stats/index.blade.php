@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Stats
                </div>
                <div class="panel-body">
                    <p>Amount of:</p>
                    <p>- trios: {{ $stats['triosCount'] }}</p>
                    <p>- attempts: {{ $stats['totalAttempts'] }}</p>
                    <p>- trios solved: {{ $stats['triosSolved'] }}</p>
                    <p>- correct answers: {{ $stats['correctAnswers'] }} </p>
                    <p>Most solved trios</p>
                    <ul class="list-group">
                    @foreach($stats['mostSolved'] as $trioStats)
                        <li class="list-group-item">{{ $trioStats->trio_id }}: {{ $trioStats->solved }}</li>
                    @endforeach
                    </ul>
                    <p>Hardest (attempts/times solved)</p>
                    <ul class="list-group">
                        @foreach($stats['hardest'] as $trioStats)
                            <li class="list-group-item">{{ $trioStats->trio_id }}: {{ $trioStats->attempts }}/{{ $trioStats->solved }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection