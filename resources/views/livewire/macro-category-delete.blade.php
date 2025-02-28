<div>

    <button type="button" class="btn btn-sm btn-danger" data-coreui-toggle="modal"
        data-coreui-target="#deleteMacroCategoryModal{{ $macroCategory->id }}">
        <i class="text-white fa-solid fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteMacroCategoryModal{{ $macroCategory->id }}" tabindex="-1"
        aria-labelledby="deleteMacroCategoryModal{{ $macroCategory->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMacroCategoryModal{{ $macroCategory->id }}Label">{{ __('Delete') }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure you want to delete') }} <strong>{{ $macroCategory->name }}</strong>?</p>
                    <i class="fa fa-triangle-exclamation text-warning"></i> <i class="text-danger">{{ __('All categories, sub-categories and dishes under this category will be deleted') }}</i>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-coreui-dismiss="modal">{{ __('Close') }}</button>
                        <button type="button" class="btn btn-danger" wire:click='deleteMacroCategory'>{{ __('Delete') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
