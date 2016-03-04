<tr>
	<td>
		{{ $leter->created_at->formatLocalized('%d %B %Y %H:%M') }}
	</td>
	<td>
		<strong>{{ $leter->title }}</strong>
	</td>
	<td class="text-right">
		<a href="{{ secure_url('leter/'.$leter->id.'/delete') }}" class="btn btn-default btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
	</td>
</tr>