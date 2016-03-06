<tr class='clickable-row' data-href="files/{{ $file->content }}">
{{-- 	<td>
		<strong>{{ $file->content }}</strong>
	</td> --}}
	<td>
		@if (str_contains($file->content, ".txt.gpg"))
			<i class="fa fa-file-text-o"></i> - Text
		@elseif (str_contains($file->content, ".jpg.gpg"))
			<i class="fa fa-file-image-o"></i> - Picture
		@else
			<i class="fa fa-file-audio-o"></i> - Audio
		@endif
	</td>
	<td>
		{{ $file->created_at }}
	</td>
{{-- 	<td>
		{{ $bag->periodicityName() }}
		@if ($bag->disable_at != null)
			<strong style="color:red;">(Disabled)</strong> 
		@endif
	</td> --}}
{{-- 	<td class="text-right">
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
	</td> --}}
</tr>