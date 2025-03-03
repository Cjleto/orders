@extends('layouts.app')

@section('content')
    <div class="mb-4 card">
        <div class="card-header">
            {{ __('Users') }}
        </div>



        <div class="card-body">
            <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name ?? old('name') }}" required autofocus>
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
                            <input id="email" name="email" type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ $user->email ?? old('email') }}" required>
                            @error('email')
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
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password" value="{{ old('password') }}"
                                class="form-control @error('password') is-invalid @enderror" @required(Route::currentRouteName() != 'users.edit')>
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
                            @foreach ($roles as $role)
                                <div class="form-check @error('role') is-invalid @enderror">
                                    <input class="form-check-input @error('role') is-invalid @enderror" type="radio"
                                        name="role" id="role-{{ $role->id }}" value="{{ $role->name }}"
                                        @if ($user->roles->contains($role)) checked @endif>
                                    <label class="form-check-label @error('role') is-invalid @enderror"
                                        for="role-{{ $role->id }}">
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
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
            </form>
        </div>

        <div class="card-footer">
        </div>
    </div>
@endsection
