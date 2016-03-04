@if (session('error'))
    <div class="alert alert-danger">
        <i class="fa fa-btn fa-exclamation-circle"></i>{{ session('error') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif