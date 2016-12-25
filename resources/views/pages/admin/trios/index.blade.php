@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Sentence 1</th>
                    <th>Sentence 2</th>
                    <th>Sentence 3</th>
                    <th>Explanation 1</th>
                    <th>Explanation 2</th>
                    <th>Explanation 3</th>
                    <th>Answer</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trios as $trio)
                    <tr>
                        <th>{{ $trio->id }}</th>
                        <th>{{ $trio->sentence1 }}</th>
                        <th>{{ $trio->sentence2 }}</th>
                        <th>{{ $trio->sentence3 }}</th>
                        <th>{{ str_limit($trio->explanation1, $limit = 50, $end = '...') }}</th>
                        <th>{{ str_limit($trio->explanation2, $limit = 50, $end = '...') }}</th>
                        <th>{{ str_limit($trio->explanation3, $limit = 50, $end = '...') }}</th>
                        <th>{{ $trio->answer }}</th>
                        <th><a href='{{ action('TriosController@show', $trio->id) }}'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list-alt"></span></button></a></th>
                        <th><a href='{{ action('TriosController@edit', $trio->id) }}'><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></th>
                        <th>
                            <!-- Delete Button -->
                            {{-- To musi być formularz, albo dołączamy więcej js. --}}
                            {{-- See: https://laravel.com/docs/5.2/quickstart-intermediate#adding-the-delete-button --}}
                            <form action="{{ action('TriosController@destroy', $trio->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger btn-xs">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </form>

                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection