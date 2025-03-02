@extends('layouts.guest')

@section('content')
    <div class="col-lg-6">
        <div class="card-group d-block d-md-flex row">
            <div class="p-4 mb-0 card col-md-7">
                <div class="card-body">
                    <h1>{{ __('Login') }}</h1>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3 input-group"><span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                                </svg></span>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                                placeholder="{{ __('Email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4 input-group"><span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                </svg></span>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" placeholder="{{ __('Password') }}" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button class="px-4 btn btn-primary" type="submit">{{ __('Login') }}</button>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="col-6 text-end">
                                    <a href="{{ route('password.request') }}" class="px-0 btn btn-link"
                                        type="button">{{ __('Forgot Your Password?') }}</a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="py-5 text-white card col-md-5 bg-primary">
                <div class="text-center card-body">
                    <div>
                        <h2>{{ __('Sign up') }}</h2>
                        <a href="{{ route('register') }}"
                           class="mt-3 btn btn-lg btn-outline-light">{{ __('Register') }}</a>
                    </div>
                </div>
            </div> --}}
        </div>

    </div>
@endsection
