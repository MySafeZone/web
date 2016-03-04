@extends('layouts.app')

@section('title')
	Decrypt
@endsection

@section('javascripts')
	<script src="/js/crypto.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
				    <div class="panel-heading">Decrypt</div>
					    <div class="panel-body">
					    	<form  role="form" class="form-horizontal">
							    <input type="hidden" id="shares" value="{{ $bag->shares }}" />

							    <div class="form-group">
									<label for="key" class="col-md-4 control-label">Your key</label>
									<div class="col-md-6">
										<textarea class="form-control" rows="7" id="key"></textarea>
									</div>
								</div>

								@each('helpers.leter_decrypt', $bag->leters, 'leter', 'helpers.decrypt_empty')

								<div class="form-group">
				                    <div class="col-sm-6 col-sm-offset-4">
				                        <a  onClick="decrypt();" class="btn btn-primary">
				                            <i class="fa fa-btn fa-key"></i> Decrypt
				                        </a>
				                    </div>
				                </div>
							</form>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection