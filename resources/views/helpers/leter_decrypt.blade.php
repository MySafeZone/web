<div class="form-group">
	<label for="key" class="col-md-4 control-label">Leter on {{ $leter->created_at->formatLocalized('%d %B %Y %H:%M') }}</label>
	<div class="col-md-6">
		<textarea class="form-control message" rows="7" readonly>{{ $leter->content }}</textarea>
	</div>
</div>