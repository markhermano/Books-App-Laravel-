@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger">
    {{ $error }}
</div>
@endforeach
@else
@if(Session::has('message'))
<div class="alert alert-success">
    {{ Session::get('message')}}
</div>
@endif
@endif
