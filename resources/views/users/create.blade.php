@extends('layouts.app')

@section('content')
    <div class="mb-4 card">
        <div class="card-header">
            {{ __('Users') }}
        </div>



        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('email') }}</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="role" class="form-label">{{ __('Role') }}</label>
                            @foreach($roles as $role)
                                <div class="form-check @error('role') is-invalid @enderror">
                                    <input class="form-check-input @error('role') is-invalid @enderror"
                                        type="radio"
                                        name="role"
                                        id="role-{{ $role->id }}"
                                        value="{{ $role->name }}"
                                    >
                                    <label class="form-check-label @error('role') is-invalid @enderror" for="role-{{ $role->id }}">
                                    {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="m-3 col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            {{ __('save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-footer">
        </div>
    </div>
@endsection
