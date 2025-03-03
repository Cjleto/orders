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
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('email') }}</th>
                        <th scope="col">{{ __('Roles') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles()->pluck('name') }}</td>

                            <td class="gap-1 d-flex">
                                <a href="{{ route('users.edit', $user) }}"
                                    class="btn btn-sm btn-primary">{{ __('edit') }}</a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline delete-user-form"
                                    data-title="{{ __('delete_confirm_title') }}"
                                    data-text="{{ __('delete_confirm_text') }}"
                                    data-confirm="{{ __('delete_confirm_button') }}"
                                    data-cancel="{{ __('delete_cancel_button') }}">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger">{{ __('delete') }}</button>
                              </form>
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

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.delete-user-form').forEach(form => {
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
