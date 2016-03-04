@extends('layouts.app')

@section('title')
    Case {{ $bag->title }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @include('helpers.back', ['route' => secure_url('home')])

            <div class="panel panel-default">
                <div class="panel-heading">Case <i>{{ $bag->title }}</i></div>

                <div class="panel-body">

                    @include('helpers.status')

                    <a type="button" class="btn btn-default btn-primary" href="{{ secure_url('/leter/create?bag_id='.$bag->id ) }}"><i class="fa fa-plus-circle"></i> Leter</a><br /><br />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @each('helpers.line_leter', $bag->leters, 'leter', 'helpers.leter_empty')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection