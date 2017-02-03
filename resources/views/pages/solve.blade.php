@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Single trio {{ $trio->id }}
                </div>
                <div class="panel-body">
                    <div id = "alert_placeholder"></div>
                    <ul>
                        <li>ID: {{ $trio->id }}</li>
                        <li>sentence1: {{ $trio->sentence1 }}</li>
                        <li>sentence2: {{ $trio->sentence2 }}</li>
                        <li>sentence3: {{ $trio->sentence3 }}</li>
                        {{--<li>answer: {{ $trio->answer }}</li>--}}
                    </ul>
                    <form action="{{ action('SolveController@check', $trio->id) }}" class="form-horizontal" method="post" role="form" id="trios-form">
                        {{ csrf_field() }}
                        <input type="hidden" id="trios-answer" value="{{ $trio->answer }}">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="answer">Answer</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="answer" name="answer" placeholder="" value="" required="true" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-5">
                                    <button class="btn btn-default" type="submit">Check</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection