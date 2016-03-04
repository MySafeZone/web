@extends('layouts.app')

@section('title')
    Confirm password
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @include('helpers.back', ['route' => "javascript:history.back()"])

                <div class="panel panel-default">
                    <div class="panel-heading">{!! $title !!}</div>
                    <div class="panel-body">
                        @include('helpers.status')

                        <form class="form-horizontal" role="form" method="POST" action="{{ $url }}">
                            {!! csrf_field() !!}
                             {!! method_field($method) !!}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" value="">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-key"></i>Continue
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection