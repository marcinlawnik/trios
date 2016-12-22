@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('msg'))
                <h2>{{session('msg')}}</h2>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Trio
                </div>
                <div class="panel-body">
                    <form action="{{url('/trios')}}" class="form-horizontal" method="post" role="form">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="s1">Sentence 1</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="s1" name="s1" placeholder="" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="s2">Sentence 2</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="s2" name="s2" placeholder="" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="s3">Sentence 3</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="s3" name="s3" placeholder="" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="e1">Explanation 1</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="e1" name="e1" placeholder="" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="e2">Explanation 2</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="e2" name="e2" placeholder="" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="e3">Explanation 3</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="e3" name="e3" placeholder="" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="a">Answer</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" id="a" name="a" placeholder="" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-default" type="submit">Add</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection