@extends('layouts.guest')

@section('content')
    <div class="col-md-6">
        <div class="mx-4 mb-4 card">
            <div class="p-4 card-body">
                <h1>{{ __('Reset Password') }}</h1>

                @if (session('errors'))
                    <div class="alert alert-danger">
                        {{ session('errors') }}
                    </div>
                @endif


                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <div class="mb-3 input-group"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                            </svg></span>
                        <input class="form-control @error('email') is-invalid @enderror" type="text"
                            placeholder="{{ __('email') }}" name="email">
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
                        <input class="form-control @error('password') is-invalid @enderror" type="password" id="password"
                            name="password" placeholder="{{ __('Password') }}">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4 input-group"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                            </svg></span>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                            id="password_confirmation" name="password_confirmation"
                            placeholder="{{ __('Confirm Password') }}">
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input type="hidden" name="token" value="{{ $token }}">

                    <button class="btn btn-block btn-success" type="submit">{{ __('Reset Password') }}</button>
                </form>

            </div>
        </div>
    </div>
@endsection
