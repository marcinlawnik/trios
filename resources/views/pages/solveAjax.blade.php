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
                    <ul>
                        <li id="sentence1"></li>
                        <li id="sentence2"></li>
                        <li id="sentence3"></li>
                    </ul>
                    <form action="#" class="form-horizontal" method="post" role="form" id="trios-form">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="answer">Answer</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="answer" name="answer" placeholder="" value="" required="true" type="text">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-default" type="submit" id="check-button">Check</button>
                                <a id="idk-button" href="#"
                                   class="btn btn-danger" type="submit">I don't know</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('afterjs')
    @include('includes.solveJs')
@endsection