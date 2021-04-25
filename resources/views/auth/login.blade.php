@extends('layouts.assets')
@section('content')
 <!-- Login -->
 <div class="login-page">
    <!-- Login Block -->
    <div class="col-10 col-s-8 col-m-5 col-l-4 login-block">
        <div class="content-box">
            <h2 style="color:rgba(0, 197, 122, 0.4);text-align:center;">{{__('Al-Moasher Software House')}}</h2>
            <h1 class="title">{{ __('Login') }}</h1>
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf    
                <label for="email">{{__('Email')}}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{__('Email')}}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
                <label for="password">{{__('Password')}}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{__('Password')}}" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                
                <!-- Button -->
                <button type="submit" class="btn primary-grade block-lvl mb15 float-end">{{ __('Login') }}</button>
            </form>
            <!-- // Login Form -->
        </div>
    </div>
    <!-- // Login Block -->
</div>
<!-- // Login -->
@endsection

