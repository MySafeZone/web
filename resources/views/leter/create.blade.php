@extends('layouts.app')

@section('title')
	Create a new Leter
@endsection

@section('javascripts')
	<script src="/js/crypto.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

            	 @include('helpers.back', ['route' => secure_url('/bag/'.$bag->id) ])
            
				<div class="panel panel-default">
				    <div class="panel-heading">Create a new Leter</div>
					    <div class="panel-body">
					    	@include('helpers.status')

							<form class="form-horizontal" role="form" method="POST" action="{{ secure_url('leter') }}">
								{!! csrf_field() !!}

								<input type="hidden" name="data[bag_id]" value="{{ old('data.bag_id', $bag->id) }}" />
								<input type="hidden" name="public_key" id="public_key" value="{{ old('public_key', $bag->public_key) }}" />
								<input type="hidden" name="data[hash_content]" id="hash_content" value="{{ old('hash_content', $bag->hash_conten) }}" />

								<div class="form-group">
									<label for="data[title]" class="col-md-2 control-label">Title</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="data[title]" value="{{ old('data.title') }}" required id="title" data-toggle="tooltip" title="Title will be never sent. It's only for you. Title is used in Leters list." />
									</div>
								</div>

								<div class="form-group">
									<label for="data[content]" class="col-md-2 control-label">Content</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="7" name="data[content]" id="content" required>{{ old('data.content') }}</textarea>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-2 col-sm-offset-2">
				                        <a class="btn btn-primary has-spinner" onClick="encrypt();" id="btn_encrypt">
				                               <i class="fa fa-btn fa-key"></i> 1. Encrypt it
				                        </a>
				                    </div>
				                    <div class="col-sm-2">
				                        <button type="submit" class="btn btn-primary" disabled="disabled" id="btn_create">
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