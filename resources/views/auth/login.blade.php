@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #ffe6f2;">
    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 10px; border: none;">
        <div class="card-body text-center">
            <a href="{{url('/')}}" style="text-decoration: none;">
                <h3 class="mb-4" style="color: #d63384;">Login Beauty & CO</h3>
            </a>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                </div>
                <button type="submit" class="btn w-100" style="background-color: #ff66b2; color: white; border-radius: 5px;">Login</button>
               
            </form>
        </div>
    </div>
</div>
@endsection