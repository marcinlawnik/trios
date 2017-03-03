@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Sentence 1</td>
                    <td>Sentence 2</td>
                    <td>Sentence 3</td>
                    <td>Explanation 1</td>
                    <td>Explanation 2</td>
                    <td>Explanation 3</td>
                    <td>Answer</td>
                    <td>View</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                </thead>
                <tbody>
                @foreach($trios as $trio)
                    <tr>
                        <td>{{ $trio->id }}</td>
                        <td>{{ $trio->sentence1 }}</td>
                        <td>{{ $trio->sentence2 }}</td>
                        <td>{{ $trio->sentence3 }}</td>
                        <td>{{ str_limit($trio->explanation1, $limit = 50, $end = '...') }}</td>
                        <td>{{ str_limit($trio->explanation2, $limit = 50, $end = '...') }}</td>
                        <td>{{ str_limit($trio->explanation3, $limit = 50, $end = '...') }}</td>
                        <td>{{ $trio->answer }}</td>
                        <td><a href='{{ action('TriosController@show', $trio->id) }}'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list-alt"></span></button></a></td>
                        <td><a href='{{ action('TriosController@edit', $trio->id) }}'><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
                        <td>
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{ $trios->links() }}
            </div>
        </div>
    </div>
@endsection