@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Trio <span id="trio-id"></span>
                </div>
                <div class="panel-body">
                    <div id = "alert_placeholder"></div>
                    <ul id="sentences">
                        <li id="sentence1"></li>
                        <li id="sentence2"></li>
                        <li id="sentence3"></li>
                    </ul>
                    <form action="#" class="form-horizontal" method="post" role="form" id="trios-form">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="answer">Answer</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="answer" name="answer" placeholder="" value="" required="true" autofocus autocomplete="off" type="text">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit" id="check-button">Check</button>
                                <button class="btn btn-default" type="button" id="idk-button">I don't know</button>
                                <a target="_blank" class="report" data-href="https://github.com/AKAI-TRIOS/trios/issues/new?title=_trioID_&labels=content&body=_Sentences_">Report a mistake</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('afterjs')
    @include('includes.solveJs')
@endpush
