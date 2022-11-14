@if(session('success'))
    <div class="alert alert-success" role="alert">
        {!! session('success') !!}
    </div>
@elseif(!empty($success))
    <div class="alert alert-success" role="alert">
        {!! $success !!}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {!! session('error') !!}
    </div>
@elseif(!empty($error))
    <div class="alert alert-danger" role="alert">
        {!! $error !!}
    </div>
@elseif($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif