@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                @include('helpers.status')

                {{-- <a type="button" class="btn btn-default btn-primary" href="{{ secure_url('bag/create') }}"><i class="fa fa-plus-circle"></i> Bag</a><br /><br /> --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    {{-- <th>Name</th> --}}
                                    <th>File</th>
                                    <th>Date</th>
                                    {{-- <th class="text-right">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @each('helpers.line_file', $files, 'file', 'helpers.file_empty')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection