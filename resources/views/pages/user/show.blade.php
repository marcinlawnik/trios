@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    User {{ $user->name }}
                </div>
                <div class="panel-body">
                    <ul>
                        <li>User ID: {{ $user->id }}</li>
                        <li>Attempted trios: {{ $user->attemptedTrios() }}</li>
                        <li>Total attempts: {{ $user->triosAttempts->sum('attempts') }}</li>
                        <li>Attempts per trio: {{ round($user->triosAttempts->avg('attempts'), 2) }}</li>
                        <li>Solved: {{ $user->solvedTrios() }}</li>
                    </ul>
                </div>
            </div>

            @if(count($user->triosAttempts))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Attempted trios
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>Trio ID</th>
                                <th>Attempts</th>
                                <th>Solved</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->triosAttempts as $attempt)
                                <tr>
                                    <td>
                                        <a href="{{-- action('SolveController@show', ['trio' => $attempt->trio_id]) --}}">
                                            {{ $attempt->trio_id }}
                                        </a>
                                    </td>
                                    <td>{{ $attempt->attempts }}</td>
                                    @if ($attempt->solved)
                                        <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                    @else
                                        <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                    @endif
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