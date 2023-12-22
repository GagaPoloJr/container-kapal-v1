<x-dialog-modal-custom wire:model.live="isModalOpen" wire:click="closeModalPopover">
    <x-slot name="title">
        {{ $isUpdatePage ?  __('Edit Customer') : __('Add Customer') }}
    </x-slot>
    <x-slot name="content">
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="kode" label="{{ __('Kode Pelanggan') }}" required />
                <x-form-input name="kode" id="kode" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="kode"  autocomplete="kode" />
                <x-form-input-error for="kode" class="mt-2" />
            </div>
            <!-- kode perusahaan -->
            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="nama" label="{{ __('Nama') }}"  required />
                <x-form-input name="nama" id="nama" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="nama"  autocomplete="nama" />
                <x-form-input-error for="nama" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="email" label="{{ __('Email') }}"  required />
                <x-form-input name="email" id="email" type="email" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="email"  autocomplete="email" />
                <x-form-input-error for="email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="no_hp" label="{{ __('Nomor Hp') }}"  required />
                <x-form-input name="no_hp" id="no_hp" type="no_hp" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="no_hp"  autocomplete="no_hp" />
                <x-form-input-error for="no_hp" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="alamat" label="{{ __('Alamat') }}"  required />
                <x-form-input name="alamat" id="alamat" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="alamat"  autocomplete="alamat" />
                <x-form-input-error for="alamat" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="asal" label="{{ __('Asal') }}"  required />
                <x-form-input name="asal" id="asal" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="asal"  autocomplete="asal" />
                <x-form-input-error for="asal" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="npwp" label="{{ __('NPWP') }}"  required />
                <x-form-input name="npwp" id="npwp" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="npwp"  autocomplete="npwp" />
                <x-form-input-error for="npwp" class="mt-2" />
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
