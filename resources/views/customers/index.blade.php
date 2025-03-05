@extends('layouts.app')

@section('content')
    <div class="mb-4 card">
        <div class="card-header">
            {{ __('customers') }}
        </div>



        <div class="overflow-auto card-body">

            <div class="mb-3 d-flex justify-content-between">
                <a href="{{ route('customers.create') }}" class="btn btn-primary">Create customer</a>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Full_Name') }}</th>
                        <th scope="col">{{ __('email') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->full_name }}</td>
                            <td>{{ $customer->email }}</td>


                            <td class="gap-1 d-flex">
                                <a href="{{ route('customers.show', $customer) }}"
                                        class="btn btn-sm btn-primary"
                                        data-coreui-toggle="tooltip" data-coreui-placement="top"
                                        data-coreui-custom-class="custom-tooltip" data-coreui-title="{{ __('Show') }}">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('icons/coreui.svg#cil-magnifying-glass') }}"></use>
                                        </svg>
                                    </a>
                                <a href="{{ route('customers.edit', $customer) }}"
                                    class="btn btn-sm btn-warning"><i class="text-white fa-solid fa-pen"></i></a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline delete-customer-form"
                                    data-title="{{ __('delete_confirm_title') }}"
                                    data-text="{{ __('delete_confirm_text') }}"
                                    data-confirm="{{ __('delete_confirm_button') }}"
                                    data-cancel="{{ __('delete_cancel_button') }}">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger"><i class="text-white fa-solid fa-trash"></i></button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $customers->links() }}
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.delete-customer-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                let title = form.getAttribute('data-title');
                let text = form.getAttribute('data-text');
                let confirmButtonText = form.getAttribute('data-confirm');
                let cancelButtonText = form.getAttribute('data-cancel');

                Swal.fire({
                    title: title,
                    text: text,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: cancelButtonText
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
    </script>
@endsection
