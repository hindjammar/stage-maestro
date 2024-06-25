@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('styles/register.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>

<div class=" containner">
    <div class="mx-auto containere" id="containere">
        <div class="w-full form-container sign-up-container">
            <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1 class="text-bold text-lg" style="font-weight:bold; color:black; margin:0; margin-top:20px;">Create Account</h1>
			<div class="social-containere">
				<a href="#" class="social" style="text-decoration:none;"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social" style="text-decoration:none;"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social" style="text-decoration:none;"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span class="text-md">or use your email for registration</span>
                        <div class="row mb-3">
                            <div class="w-72 col-md-6">
                                <input id="name" placeholder="Username" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                        <div class="w-72 col-md-6">
                                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                        <div class="w-72 col-md-6">
                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                        <div class="w-72 col-md-6">
                                <input id="password-confirm" placeholder="Confirm password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 ">
                                <button type="submit" class="w-24 bg-red-400 p-2 rounded-2xl hover:bg-red-500">
                                    Sign Up
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
        <div class="w-full bg-red-400">
            <div class="p-12 flex flex-col justify-center items-center mt-24">
                <h1 class="text-bold text-lg text-white">Hello, Friend!</h1>
                <p class="text-center text-white">Enter your personal details and start journey with us</p>
                <a href="{{ route('login') }}"><button class="hover:bg-red-500 ghost" id="signIn">Sign In</button></a>
            </div>
        </div>
    </div>
</div>

@endsection
