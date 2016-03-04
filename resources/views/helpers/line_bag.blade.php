<tr>
	<td>
		{{ str_limit($bag->recipients, 25, '...') }}
	</td>
	<td>
		<strong>{{ $bag->title }}</strong>
	</td>
	<td>
		{{ $bag->periodicityName() }}
		@if ($bag->disable_at != null)
			<strong style="color:red;">(Disabled)</strong> 
		@endif
	</td>
	<td class="text-right">
		<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
			<li><a href="{{ secure_url('/bag/'.$bag->id) }}"><i class="fa fa-folder-open-o"></i> Open</a></li>
			@if ($bag->disable_at == null)
			<li><a href="{{ secure_url('bag/'.$bag->id.'/disable') }}"><i class="fa fa-ban"></i> Disable</a></li>
			@else
			<li><a href="{{ secure_url('bag/'.$bag->id.'/enable') }}"><i class="fa fa-play"></i> Enable</a>	</li>
			@endif
			<li><a href="{{ secure_url('bag/'.$bag->id.'/delete') }}"><i class="fa fa-trash-o"></i> Delete</a></li>
			<li><a href="{{ secure_url('bag/'.$bag->id.'/send') }}"><i class="fa fa-paper-plane-o"></i> Send now</a></li>
		  </ul>
		</div>
	</td>
</tr>