@extends('layouts.app')

@section('content')
    <div class="mb-4 card">
        <div class="card-header">
            {{ __('Users') }}
        </div>



        <div class="overflow-auto card-body">

            <div class="mb-3 d-flex justify-content-between">
                <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">{{__('Name')}}</th>
                    <th scope="col">{{__('Email')}}</th>
                    <th scope="col">{{__('Roles')}}</th>
                    <th scope="col">{{__('Company')}}</th>
                    <th scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles()->pluck('name') }}</td>
                        <td>
                            @if($user?->company?->name)
                                {{ $user?->company?->name  }}
                            @else
                                <div class="badge bg-warning">{{ __('No company') }}</div>
                            @endif
                        </td>
                        <td class="gap-1 d-flex">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">Edit</a>
                            @canBeImpersonated($user)
                                <a href="{{ route('impersonate', $user->id) }}" class="btn btn-sm btn-outline-info">Impersonate</a>
                            @endCanBeImpersonated
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
@endsection
