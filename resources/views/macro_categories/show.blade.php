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
                            @foreach ($company->users as $user )
                                @can('manage_users', $user)
                                    <a href="{{ route('users.edit', $user) }}" class="">{{ $user->name }}</a>
                                @else
                                    <span class="badge rounded-pill bg-danger">{{ $user->name }}</span>
                                @endcan
                            @endforeach
                        </li>
                        <li class="p-1 list-group-item">
                            <span>Expiration date:</span> {{ $company->expiration_date?->format('d/m/Y') }}
                        </li>

                        <li class="p-1 list-group-item">Address: {{ $company->address }}</li>
                        <li class="p-1 list-group-item">Slug: {{ $company->slug }}</li>
                    </ul>

                </div>

                <div class="col-12 col-md-2 text-end">
                    <img src="{{ $company->getFirstMediaUrl('logo','thumb_sharp') }}" alt="thumbnail" class="img-thumbnail">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="mb-3 accordion" id="accordionRestaurantData">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              {{ __('Data') }}
                            </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse show" data-coreui-parent="#accordionRestaurantData">
                            <div class="accordion-body">
                              <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Menus
                            </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse" data-coreui-parent="#accordionRestaurantData">
                            <div class="accordion-body">
                              <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" i>
                            <button class="accordion-button collapsed" type="button" data-coreui-toggle="collapse" data-coreui-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Accordion Item #3
                            </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" data-coreui-parent="#accordionRestaurantData">
                            <div class="accordion-body">
                              <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                          </div>
                        </div>
                      </div>





        </div>

        <div class="card-footer">
        </div>
    </div>
@endsection

