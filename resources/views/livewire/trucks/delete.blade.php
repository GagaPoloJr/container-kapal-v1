<x-dialog-modal-custom wire:model="isModalDelete">
    <x-slot name="title">
        {{ __('Confirm Delete') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete this item?') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('isModalDelete')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button-cst class="ms-3" wire:click="delete()" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-button-cst>
    </x-slot>
</x-dialog-modal-custom>
