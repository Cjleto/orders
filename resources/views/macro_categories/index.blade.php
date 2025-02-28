@extends('layouts.app')

@section('content')
    <div class="flex mb-2 row ">
        <div class="col-3 align-content-end">
            <div class="mb-2 btn-toolbar mb-md-0">
                <a href="{{ route('macro_categories.create') }}" class="btn btn-sm btn-primary">Create Macro</a>
            </div>
        </div>
    </div>

    <div class="mb-4 card">
        <div class="card-header">
            {{ __('Macro Category') }}
        </div>

        <div class="card-body">
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Id') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Description') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($macro_categories as $macro)
                        <tr>
                            <td>{{ $macro->id }}</td>
                            <td>{{ $macro->name }}</td>
                            <td>{{ $macro->description }}</td>

                            <td class="gap-2 d-flex justify-content-start">
                                <a href="{{ route('macro_categories.show', $macro) }}" class="btn btn-sm btn-info"
                                    data-coreui-toggle="tooltip" data-coreui-placement="top"
                                    data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Show') }}">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-search') }}"></use>
                                    </svg>
                                </a>
                                <a href="{{ route('macro_categories.edit', $macro) }}" class="btn btn-sm btn-warning"
                                    data-coreui-toggle="tooltip" data-coreui-placement="top"
                                    data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Edit') }}">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-pencil') }}"></use>
                                    </svg>
                                </a>
                                <livewire:togglevisible :macro_category="$macro" :wire:key="$macro->id">
                            </td>


                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $macro_categories->links() }}
        </div>
    </div>
@endsection
