@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="border-0 shadow-lg card">
            <div class="text-white card-header bg-primary">
                <h4 class="mb-0">{{ __('Customer Details') }}</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-muted">{{ __('First Name') }}</h5>
                        <p class="fw-bold">{{ $customer->first_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-muted">{{ __('Last Name') }}</h5>
                        <p class="fw-bold">{{ $customer->last_name }}</p>
                    </div>
                </div>

                <div class="mt-3 row">
                    <div class="col-md-6">
                        <h5 class="text-muted">{{ __('Email') }}</h5>
                        <p class="fw-bold">{{ $customer->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-muted">{{ __('Phone') }}</h5>
                        <p class="fw-bold">{{ $customer->phone }}</p>
                    </div>
                </div>

                <div class="mt-3 row">
                    <div class="col-12">
                        <h5 class="text-muted">{{ __('Address') }}</h5>
                        <p class="fw-bold">{{ $customer->address }}</p>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                </a>

                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
            </div>
        </div>
    </div>
@endsection
