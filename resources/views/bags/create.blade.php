@extends('layouts.app')

@section('title')
	Create a new Bag
@endsection

@section('javascripts')
	<script src="/js/crypto.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

            	@include('helpers.back', ['route' => secure_url('home')])

				<div class="panel panel-default">
				    <div class="panel-heading">Create a new Bag</div>
					    <div class="panel-body">
					    	@include('helpers.status')

							<div class="alert alert-warning" role="alert" id="list_emails" style="display: none;">
								
							</div>

							<form class="form-horizontal" role="form" method="POST" action="{{ secure_url('/bag') }}">
								{!! csrf_field() !!}

								<input type="hidden" name="data[shares]" id="shares" value="{{ old('data.shares') }}" />
								<input type="hidden" name="data[public_key]" id="public_key" value="{{ old('data.public_key') }}" />

								<div class="form-group">
									<label for="data[recipients]" class="col-md-2 control-label">Recipients</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="data[recipients]" id="recipients" value="{{ old('data.recipients') }}" required id="recipients" data-toggle="tooltip" title="Recipients must be comma-separated without space format." />
									</div>
								</div>

								<div class="form-group">
									<label for="data[title]" class="col-md-2 control-label">Title</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="data[title]" value="{{ old('data.title') }}" required id="title" data-toggle="tooltip" title="Title will be never sent. It's only for you. Title is used in Bags list." />
									</div>
								</div>

								<div class="form-group">
									<label for="data[periodicity]" class="col-md-2 control-label">Periodicity</label>
									<div class="dropdown col-md-9">
										<select class="form-control" name="data[periodicity]" id="periodicity">
											<option value="0">Choose a periodicity</option>
											@foreach ($periodicities as $periodicity_id => $periodicity_name)
												<option value="{{ $periodicity_id }}" {{ (old("data.periodicity") == $periodicity_id ? "selected":"") }}>{{ $periodicity_name }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-2 col-sm-offset-2">
				                        <a class="btn btn-primary has-spinner" href="javascript:generateKey();" id="btn_generate">
				                               <i class="fa fa-btn fa-key"></i> 1. Generate
				                        </a>
				                    </div>
				                    <div class="col-sm-2">
				                        <button type="submit" class="btn btn-primary" id="btn_create" disabled="disabled" onclick="return confirm('Have you correctly sent the emails from your computer ?');">
				                               <i class="fa fa-btn fa-check-circle"></i> 2. Create
				                        </button>
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