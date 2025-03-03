@extends('layouts.app')

@section('content')
    <div class="mb-4 card">
        <div class="card-header">
            {{ __('edit Roles') }}
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('roles.update', ['role' => $role]) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ $role->name ?? old('name') }}" required autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="permissions" class="form-label">{{ __('Permissions') }}</label>
                    @foreach($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input @error('permissions') is-invalid @enderror"
                                type="checkbox"
                                id="permission_{{ $permission->id }}"
                                name="permissions[]"
                                value="{{ $permission->name }}"
                                @if($role->permissions->contains($permission)) checked @endif
                                >
                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach

                    @error('permissions')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                </button>

        </div>

        <div class="card-footer">
        </div>
    </div>
@endsection
