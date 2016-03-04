@extends('layouts.app')

@section('title')
	Settings
@endsection

@section('content')
<div class="container">
	@include('helpers.back', ['route' => "javascript:history.back()"])
	
	<div class="row">

    	@include('settings.parts.update_email')
 		@include('settings.parts.update_password')
 		@if (Auth::user()->two_factor)
 			@include('settings.parts.disable_two_factor')
 		@else
 			@include('settings.parts.enable_two_factor')
 		@endif
 		@include('settings.parts.update_coercion_password')
    </div>
</div>
@endsection