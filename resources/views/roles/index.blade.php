@extends('layouts.app')

@section('content')
    <div class="flex mb-2 row ">
        <div class="col-3 align-content-end">
            <div class="mb-2 btn-toolbar mb-md-0">
                <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">Create Role</a>
            </div>
        </div>
    </div>

    <div class="mb-4 card">
        <div class="card-header">
            {{ __('Roles') }}
        </div>

        <div class="card-body">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Permissions</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission)
                                <div class="badge bg-secondary rounded-pill">
                                    {{ $permission->name }}
                                </div>
                            @endforeach
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-primary">Edit</a>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
        </div>
    </div>
@endsection
