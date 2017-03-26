@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Trio ID</th>
                    <th>Edit trio</th>
                    <th>Description</th>
                    <th>Delete report</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <th>{{ $report->id }}</th>
                        <th>{{ $report->trio_id }}</th>
                        <th><a href='{{ action('TriosController@edit', $report->trio_id) }}'><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></th>
                        <th>{{ $report->description or '' }}</th>
                        <th>
                            <!-- Delete Button -->
                            {{-- To musi być formularz, albo dołączamy więcej js. --}}
                            {{-- See: https://laravel.com/docs/5.2/quickstart-intermediate#adding-the-delete-button --}}
                            <form action="{{ action('ReportController@destroy', $report->id) }}" method="POST">
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
            <div class="text-center">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
@endsection