@if($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    <p>{{$message}}</p>
</div>
@endif

@if($message = Session::get('error'))
<div class="alert alert-warning" role="alert">
    <p>{{$message}}</p>
</div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    Upload Validation Error
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif