@extends('layouts.app')

@section('content')

    <div class="flex mb-2 row ">
                <div class="col-3 align-content-end">
            <div class="mb-2 btn-toolbar mb-md-0">
                <a href="{{ route('companies.index') }}" class="btn btn-sm btn-primary">View companies</a>
            </div>
        </div>
    </div>

    <div class="mb-4 card">
        <div class="card-header">
            {{ __('companies') }}
        </div>

        <div class="card-body">
            @livewire('company-create')
            {{-- <form method="POST" action="{{ route('companies.store') }}">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <input type="image" src="{{ asset('images/company.jpg') }}" alt="company" class="img-thumbnail"
                            width="100" height="100">
                    </div>
                </div>

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
                            <label for="address" class="form-label">{{ __('Address') }}</label>
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                                value="{{ old('address') }}" required autofocus>
                            @error('address')
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
                            <label for="phone" class="form-label">{{ __('Phone') }}</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" required autofocus>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
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
                            <label for="website" class="form-label">{{ __('Website') }}</label>
                            <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website"
                                value="{{ old('website') }}" required autofocus>
                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">{{ __('Slug') }}</label>
                            <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                                value="{{ old('slug') }}" required autofocus>
                            @error('slug')
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
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                                value="{{ old('description') }}" autofocus>
                            </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                </div>
            </form> --}}
        </div>

        <div class="card-footer">
        </div>
    </div>
@endsection
