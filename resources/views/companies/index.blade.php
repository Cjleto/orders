@extends('layouts.app')

@section('content')

    <div class="flex mb-2 row ">
        <div class="col-3 align-content-end">
            <div class="mb-2 btn-toolbar mb-md-0">
                <a href="{{ route('companies.create') }}" class="btn btn-sm btn-primary">Create company</a>
            </div>
        </div>
    </div>

    <div class="mb-4 card">
        <div class="card-header">
            {{ __('companies') }}
        </div>

        <div class="overflow-auto card-body">

            <table class="table table-hover table-responsive">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Manager</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->address }}</td>
                        <td>
                            @can('manage_users')
                                <a href="{{ route('users.edit', $company->user) }}" class="btn btn-sm btn-primary">{{ $company->user->name }}</a>
                            @else
                                <span class="badge rounded-pill bg-danger">{{ $company->user->name }}</span>
                            @endcan
                        </td>
                        <td class="gap-2 d-flex justify-content-start">
                            <a href="{{ route('companies.show', $company) }}" class="btn btn-sm btn-info">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                                </svg>
                            </a>
                            <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-warning">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                </svg>
                            </a>
                            <a href="{{ route('public.menu', $company) }}" class="btn btn-sm btn-primary" target="_alt">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-browser') }}"></use>
                                </svg>
                            </a>

                    </tr>
                @endforeach


                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $companies->links() }}
        </div>
    </div>
@endsection

