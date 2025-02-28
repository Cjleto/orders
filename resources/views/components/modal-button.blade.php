<div>
    <!-- Button trigger modal -->
    <div class="btn btn-sm btn-{{ $class }}" data-coreui-toggle="modal" data-coreui-target="#{{ $modalId }}">
        <svg class="icon">
            <use xlink:href="{{ asset('icons/coreui.svg#' . $icon) }}"></use>
        </svg>
    </div>

    <!-- Modal -->
    <div class="modal fade {{ $modalClass }}" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
        <div class="modal-dialog {{ $modalDialog }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $body }}
                    {{ $slot }}
                </div>
                <div class="modal-footer {{ $footerClass }}">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">{{ $saveText }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
