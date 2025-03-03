<div>

    <button type="button" class="btn btn-sm btn-danger" data-coreui-toggle="modal"
        data-coreui-target="#deleteProductModal{{ $product->id }}">
        <i class="text-white fa-solid fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1"
        aria-labelledby="deleteProductModal{{ $product->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModal{{ $product->id }}Label">{{ __('Delete') }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('confirm_delete') }} <strong>{{ $product->name }}</strong>?</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-coreui-dismiss="modal">{{ __('Close') }}</button>
                        <button type="button" class="btn btn-danger" wire:click='deleteProduct'>{{ __('Delete') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
