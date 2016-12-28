@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Single trio {{ $trio->id }}
                </div>
                <div class="panel-body">
                    <ul>
                        <li>ID: {{ $trio->id }}</li>
                        <li>sentence1: {{ $trio->sentence1 }}</li>
                        <li>sentence2: {{ $trio->sentence2 }}</li>
                        <li>sentence3: {{ $trio->sentence3 }}</li>
                        <li>explanation1: {{ $trio->explanation1 }}</li>
                        <li>explanation2: {{ $trio->explanation2 }}</li>
                        <li>explanation3: {{ $trio->explanation3 }}</li>
                        <li>answer: {{ $trio->answer }}</li>
                        <li>created at: {{ $trio->created_at }}</li>
                        <li>updated at: {{ $trio->updated_at }}</li>
                        <li><a href='{{ action('TriosController@edit', $trio->id) }}'>Edit trio</a></li>
                    </ul>
                </div>
            </div>

            @if(count($trio->wrongAnswers))
            <div class="panel panel-default">
                <div class="panel-heading">
                    Wrong answers for this trio
                </div>
                <div class="panel-body">
                    <ul>
                        @foreach($trio->wrongAnswers as $wrongAnswer)
                        <li>{{ $wrongAnswer->answer }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-12">
            @if(count($trio->changes))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Changes
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Field</th>
                                <th>Before</th>
                                <th>After</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($trio->changes as $change)
                                <tr>
                                    <td>{{ $change->user_id }}</td>
                                    <td><pre>{{ $change->field_name }}</pre></td>
                                    <td><pre>{{ $change->before }}</pre></td>
                                    <td><pre>{{ $change->after }}</pre></td>
                                    <td>{{ $change->created_at->format('m-d-Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection