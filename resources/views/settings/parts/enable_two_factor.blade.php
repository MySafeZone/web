<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">Enable two-factor authentication</div>
        <div class="panel-body text-center">

            @if (session('enable_2fa.status'))
                <div class="alert alert-success">
                    <i class="fa fa-btn fa-check-circle"></i>{{ session('enable_2fa.status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ secure_url('settings/user/two-factor') }}">
                {!! csrf_field() !!}

                <input type="hidden" name="enable_2fa[google_2fa]" value="{{ old('enable_2fa.google_2fa', $google2fa_secret) }}" />
                <input type="hidden" name="enable_2fa[google_2fa_url]" value="{{ old('enable_2fa.google_2fa_url', $google2fa_url) }}" />

                <div class="form-group">
                    <div class="col-md-12">
                        <img src="{{ old('enable_2fa.google_2fa_url', $google2fa_url) }}" />
                    </div>
                </div>

                <div class="form-group{{ $errors->has('enable_2fa.code') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Validation code</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="enable_2fa[code]" />

                        @if ($errors->has('enable_2fa.code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('enable_2fa.code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6  col-md-offset-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-play"></i>Enable
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>