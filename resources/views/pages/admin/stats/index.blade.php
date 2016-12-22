@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Stats
                </div>
                <div class="panel-body">
                    <p>Amount of trios: {{ $stats['triosCount'] }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection