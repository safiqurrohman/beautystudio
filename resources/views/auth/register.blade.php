@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #ffe6f2;">
    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 10px; border: none;">
        <div class="card-body text-center">
            <a href="{{url('/')}}" style="text-decoration: none;">
                <h3 class="mb-4" style="color: #d63384;">Daftar Beauty & CO</h3>
            </a>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3  text-start">
                    <label for="name" class="form-label">{{ __('Nama') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3  text-start">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3  text-start">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn text-white w-100" style="background-color: palevioletred;">
                        {{ __('Register') }}
                    </button>
                </div>
                <div class="mt-3">Sudah memiliki punya akun?
                    @if (Route::has('password.request'))
                    <a class="text-decoration-none" href="{{ route('login') }}" style="color: #d63384;">Login</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection