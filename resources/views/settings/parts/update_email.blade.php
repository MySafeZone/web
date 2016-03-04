<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">Update email</div>
        <div class="panel-body">

            @if (session('update_email.status'))
                <div class="alert alert-success">
                    <i class="fa fa-btn fa-check-circle"></i>{{ session('update_email.status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ secure_url('settings/user/email') }}">
                {!! csrf_field() !!}
                {!! method_field('PATCH') !!}

                <div class="form-group{{ $errors->has('update_email.email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Email</label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="update_email[email]" value="{{ old('update_email.email', Auth::user()->email) }}" />

                        @if ($errors->has('update_email.email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('update_email.email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('update_email.password') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Current password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" name="update_email[password]" />

                        @if ($errors->has('update_email.password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('update_email.password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-save"></i>Update email
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>