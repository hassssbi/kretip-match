@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row py-3 justify-content-between">
        <div class="col-md-6">
            <h1 class="text-center">Welcome to Kretip Match</h1>
            <div class="img d-flex justify-content-center">
                <img src="{{ asset('admin/dist/img/kretip-match-logo-v1-wide.png')}}" alt="" class="">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="card-title">
                    <h3 class="text-center">Login</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="ali@example.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="*******">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    @if (Route::has('password.request'))
                                    <a class="mb-1" href="{{ route('password.request') }}">Forgot your Password?</a>
                                    @endif
                                    <br>
                                    <a href="{{ route('register') }}">Register an Account Here!</a>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary float-right">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
