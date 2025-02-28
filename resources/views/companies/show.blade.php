@extends('layouts.app')

@section('content')

    <div class="mb-4 card">
        <div class="card-header justify-content-between d-flex">
            <div>{{ $company->name }}</div>
            <div>
                @if($company->isExpired())
                    <div class="badge bg-danger" role="badge">
                        This company is expired
                    </div>
                @elseif($company->isExpiringInAMonth())
                    <div class="badge bg-warning" role="badge">
                        This company is expiring soon
                    </div>
                @else
                    <div class="badge bg-success" role="badge">
                        Remaining days: {{ $company->remainingDays() }}
                    </div>
                @endif
            </div>
        </div>


        <div class="card-body">


            <div class="row justify-content-between">
                <div class="col-12 col-md-5">
                    <!-- Some borders are removed -->
                    <ul class="list-group list-group-flush small">
                        <li class="p-1 list-group-item">
                            <span>Manager:</span>
                            @can('manage_users', $company->user)
                                <a href="{{ route('users.edit', ['user' => $company->user->id ]) }}" class="">{{ $company->user->name }}</a>
                            @else
                                <span class="badge rounded-pill bg-danger">{{ $company->user->name }}</span>
                            @endcan
                        </li>
                        <li class="p-1 list-group-item">
                            <span>Expiration date:</span> {{ $company->expiration_date?->format('d/m/Y') }}
                        </li>

                        <li class="p-1 list-group-item">Address: {{ $company->address }}</li>
                        <li class="p-1 list-group-item">Slug: {{ $company->slug }}</li>
                        <li class="p-1 list-group-item">Type: {{ $company->type }}</li>
                    </ul>

                </div>

                <div class="col-12 col-md-2 text-end">
                    <img src="{{ $company->getFirstMediaUrl('logo','thumb_sharp') }}" alt="thumbnail" class="img-thumbnail">
                </div>
            </div>



        <div class="card-footer">
        </div>
    </div>
@endsection

