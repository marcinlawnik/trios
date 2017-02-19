@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Trio {{ $trio->id }}
                </div>
                <div class="panel-body">
                    <div id = "alert_placeholder"></div>
                    <ul>
                        <li>{{ $trio->sentence1 }}</li>
                        <li>{{ $trio->sentence2 }}</li>
                        <li>{{ $trio->sentence3 }}</li>
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
                            <div class="form-group text-center">
                                <button class="btn btn-default" type="submit">Check</button>
                                <a href="{{ action('SolveController@getRandom') }}"
                                   class="btn btn-danger" type="submit">I don't know</a>
                                <a target="_blank" class="report" href="https://github.com/AKAI-TRIOS/trios/issues/new?title={{$trio->id}}&amp;labels=content">Report a mistake</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
