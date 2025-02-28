<div>
    <div class="row" >

        <div class="col-12 col-md-6">
            <ul class="mb-3 nav nav-pills nav-justified" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-menu-tab" data-coreui-toggle="pill" data-coreui-target="#pills-menu"
                        type="button" role="tab" aria-controls="pills-menu" aria-selected="true">Menu</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-coreui-toggle="pill"
                        data-coreui-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Profile</button>
                </li>

            </ul>
            <div class="p-0 tab-content" id="pills-tabContent" style="background-color: unset">
                <div class="tab-pane fade show active" id="pills-menu" role="tabpanel" aria-labelledby="pills-menu-tab" tabindex="0">
                    <livewire:menu-settings-form>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <div class="mb-3 card border-primary">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Company') }} Info</h4>
                            <livewire:company-edit :company="$this->company" />
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-12" style="height: 86vh; overflow: hidden;">
                    <livewire:preview-menu :company="$this->company" wire:id="$this->company">
                </div>
            </div>
        </div>
    </div>



</div>
