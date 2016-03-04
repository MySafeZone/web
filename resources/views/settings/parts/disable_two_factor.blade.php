<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">Disable two-factor authentication</div>
        <div class="panel-body">

            @if (session('disable_2fa.status'))
                <div class="alert alert-success">
                    <i class="fa fa-btn fa-check-circle"></i>{{ session('disable_2fa.status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ secure_url('settings/user/two-factor') }}">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}

                <div class="form-group{{ $errors->has('disable_2fa.password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Current password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="disable_2fa[password]" />

                        @if ($errors->has('disable_2fa.password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('disable_2fa.password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-stop"></i>Disable
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>