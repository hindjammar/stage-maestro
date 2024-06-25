@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('styles/register.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>

<div class=" containner">
    <div class="mx-auto containere" id="containere">
        <div class="w-full form-container sign-up-container">
        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h1 class="text-bold text-lg"  style="font-weight:bold; color:black;">Sign in</h1>
                <div class="social-containere">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span class="text-md">or use your account</span>
                            <div class="row mb-3">
        
                                <div class="w-72 col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">

                                <div class="w-72 col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- <div class="">
                                <div class=" ">
                                    <div class="flex">
                                        <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="w-48" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> -->

                            <div class="row mb-0">
                                <div class="">
                                    <button type="submit" class="bg-red-400 ">
                                       Sign In                  
                                                      </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn hover:text-red-500" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
     
		   </div>
        <div class="w-full bg-red-400">
            <div class="p-12 flex flex-col justify-center items-center mt-24">
                <h1 class="text-bold text-lg text-white">Hello, Friend!</h1>
                <p class="text-center text-white">Enter your personal details and start journey with us</p>
                <a href="{{ route('register') }}"><button class="hover:bg-red-500 ghost" id="signIn">Sign Up</button></a>
            </div>
        </div>
    </div>
</div>

@endsection
