<x-dialog-modal-custom wire:model.live="isModalOpen" wire:click="closeModalPopover">
    <x-slot name="title">
        {{ $isUpdatePage ?  __('Edit Role') : __('Add Role') }}
    </x-slot>
    <x-slot name="content">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4 my-5">
            <x-form-label for="name" label="{{ __('Role Name') }}" required />
            <x-form-input name="name" id="name" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="name" autocomplete="name" />
            <x-form-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-button-cst btnColor="light" wire:click="closeModalPopover" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-button-cst>

        <x-button-cst class="ms-3" wire:click.prevent="store()" wire:loading.attr="disabled">
            {{ $isUpdatePage ?  __('Update') : __('Create') }}
        </x-button-cst>
    </x-slot>
</x-dialog-modal-custom>
