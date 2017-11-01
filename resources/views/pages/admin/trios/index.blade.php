@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ action('TriosController@create') }}" class="btn btn-primary">Add Trio</a>
            <p class="pull-right">
                Filter: <a class="btn btn-default @if(Request::query('show') == 'active') btn-primary @endif" href="{{ action('TriosController@index', ['show' => 'active']) }}" role="button">Active</a>
                <a class="btn btn-default @if(Request::query('show') == 'inactive') btn-primary @endif" href="{{ action('TriosController@index', ['show' => 'inactive']) }}" role="button">Inactive</a>
                <a class="btn btn-default  @if(!Request::has('show')) btn-primary @endif" href="{{ action('TriosController@index') }}" role="button">All</a>
            </p>
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
                    <th>Active?</th>
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
                        <td>
                            <a href="{{ action('TriosController@active', $trio->id) }}" class="active-trio">
                            @if($trio->active)
                                <span class="glyphicon glyphicon-ok-circle"></span>
                            @else
                                <span class="glyphicon glyphicon-remove-circle"></span>
                            @endif
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                @if(isset($filter))
                    {{ $trios->appends(['show' => $filter])->links() }}
                @else
                    {{ $trios->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
@push('afterjs')
<script>
    $(document).ready(function () {
        $("a.active-trio").click(function (e) {
            e.preventDefault();
            $.post(e.currentTarget.href, {_token: $("meta[name='csrf-token']").attr("content")}).done(function (response) {
                if(response.state) {
                    e.currentTarget.children[0].classList.remove('glyphicon-remove-circle');
                    e.currentTarget.children[0].classList.add('glyphicon-ok-circle');
                } else {
                    e.currentTarget.children[0].classList.add('glyphicon-remove-circle');
                    e.currentTarget.children[0].classList.remove('glyphicon-ok-circle');
                }
            });
        });
    });
</script>
@endpush