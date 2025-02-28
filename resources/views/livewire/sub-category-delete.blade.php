<div>

    <button type="button" class="btn btn-sm btn-danger" data-coreui-toggle="modal"
        data-coreui-target="#deleteSubCategoryModal{{ $subCategory->id }}">
        <i class="text-white fa-solid fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteSubCategoryModal{{ $subCategory->id }}" tabindex="-1"
        aria-labelledby="deleteSubCategoryModal{{ $subCategory->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSubCategoryModal{{ $subCategory->id }}Label">{{ __('Delete') }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure you want to delete') }} <strong>{{ $subCategory->name }}</strong>?</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-coreui-dismiss="modal">{{ __('Close') }}</button>
                        <button type="button" class="btn btn-danger" wire:click='deleteSubCategory'>{{ __('Delete') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
