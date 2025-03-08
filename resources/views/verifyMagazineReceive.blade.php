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

<!-- Toaster -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
         alpha/css/bootstrap.css" rel="stylesheet">

<div class="row justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card mx-4 shadow-lg border-0 rounded">
            <div class="card-body p-5 text-center">

                <h1 class="text-primary">BCMEA</h1>
             
                <p class="text-muted">Please Enter the 6-digit code.</p>
                <form method="POST" action="{{ route('magazine.verify') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input id="verify_code" name="verify_code" type="number" class="form-control{{ $errors->has('verify_code') ? ' is-invalid' : '' }}" required autocomplete="verify_code" value="{{ old('verify_code', null) }}">

                        @if($errors->has('verify_code'))
                            <div class="invalid-feedback">
                                {{ $errors->first('verify_code') }}
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Submit
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toaster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
              href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.success("{{ session('message') }}");
        @endif
            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.error("{{ session('error') }}");
        @endif
            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.info("{{ session('info') }}");
        @endif
            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.warning("{{ session('warning') }}");
        @endif
    </script>

@endsection
