@extends('layouts.app')

@section('content')
<style>
    h1.text-primary {
    font-size: 1.6rem; /* Adjust size */
    font-weight: bold;
    text-transform: uppercase;
    background: linear-gradient(90deg, #ff8a00, #e52e71);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 2px 2px 10px rgba(255, 138, 0, 0.4);
    letter-spacing: 2px;
    margin-bottom: 10px;
}
</style>
<div class="row justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card mx-4 shadow-lg border-0 rounded">
            <div class="card-body p-5 text-center">

                <h1 class="text-primary">Magazine Management</h1>
                
                <!-- Logo -->
               <!--  <div class="mb-4">
                    <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 120px;">
                </div> -->
                <p class="text-muted">Login to your account</p>

                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="Email Address" value="{{ old('email', null) }}">

                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>

                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="Password">

                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" name="remember" type="checkbox" id="remember" />
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                    </button>

                    <div class="mt-3">
                        @if(Route::has('password.request'))
                            <a class="text-primary" href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
