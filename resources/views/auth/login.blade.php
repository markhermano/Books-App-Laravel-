@extends('layouts.app')

@section('content')
<div class="wrapper">
    <h1 class="text-center">Books App</h1>
    <div class="card border-dark mb-3 " style="max-width: 18rem;">
        <div class="card-header">Login to your account</div>
        <div class="card-body text-dark">
            @include('components.alert')
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" required>
                </div>
                <button type="submit" class="btn btn-secondary">Login</button>@if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
