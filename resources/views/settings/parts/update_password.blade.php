<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">Update password</div>
        <div class="panel-body">
            @if (session('update_password.status'))
                <div class="alert alert-success">
                    <i class="fa fa-btn fa-check-circle"></i>{{ session('update_password.status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ secure_url('settings/user/password') }}">
                {!! csrf_field() !!}
                {!! method_field('PATCH') !!}

                <div class="form-group{{ $errors->has('update_password.current_password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Current password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="update_password[current_password]" />

                        @if ($errors->has('update_password.current_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('update_password.current_password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('update_password.password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">New password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="update_password[password]" />

                        @if ($errors->has('update_password.password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('update_password.password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('update_password.password_confirmation') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Confirm password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="update_password[password_confirmation]" />

                        @if ($errors->has('update_password.password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('update_password.password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-save"></i>Update password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>