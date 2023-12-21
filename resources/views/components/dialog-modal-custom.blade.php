@props(['id' => null, 'maxWidth' => null])

<x-modal-custom :id="$id" :maxWidth="$maxWidth" wire:click="closeModalPopover" {{ $attributes }}>
    
    <div class="modal-header">
        <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
        <button type="button" wire:click="closeModalPopover" wire:loading.attr="disabled" class="btn-close"  aria-label="Close"></button>
    </div>
    <div class="modal-body">
        {{ $content }}
    </div>
    <div class="modal-footer">
        {{ $footer }}
    </div>
    </x-modal>
