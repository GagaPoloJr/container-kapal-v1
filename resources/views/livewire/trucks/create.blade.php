{{-- <x-modal-custom  wire:model.live="isModalOpen" wire:click="closeModalPopover">
    <x-slot name="title">
        {{ $isUpdatePage ? __('Edit Truck') : __('Add Truck') }}
    </x-slot>
    <div class="modal-body">
        <div class="mb-3">
            <x-form-label required for="merk" label="{{ __('Merk') }}" />
            <x-form-input id="merk" type="text" wire:model="merk" placeholder="truck merk" 
                autocomplete="merk" />
            <x-form-input-error for="merk" class="mt-2" />
        </div>
        <div class="mb-3">
            <x-form-label required for="plat_nomor" label="{{ __('Plat Nomor') }}" />
            <x-form-input id="plat_nomor" type="text" wire:model="plat_nomor" placeholder="truck plat_nomor" 
                autocomplete="plat_nomor" />
            <x-form-input-error for="plat_nomor" class="mt-2" />
        </div>
        <div class="mb-3">
            <x-form-label required for="warna" label="{{ __('Warna') }}" />
            <x-form-input id="warna" type="text" wire:model="warna" placeholder="truck warna" 
                autocomplete="warna" />
            <x-form-input-error for="warna" class="mt-2" />
        </div>
        <div class="mb-3">
            <x-form-label required for="kapasitas" label="{{ __('Kapasitas') }}" />
            <x-form-input id="kapasitas" type="text" wire:model="kapasitas" placeholder="truck kapasitas" 
                autocomplete="kapasitas" />
            <x-form-input-error for="kapasitas" class="mt-2" />
        </div>
        
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancel
        </a>
        <button type="submit"  class="btn btn-primary ms-auto">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            Create
        </button>
    </div>

</x-modal-custom> --}}


<x-dialog-modal-custom wire:model.live="isModalOpen" wire:click="closeModalPopover">
    <x-slot name="title">
        {{ $isUpdatePage ?  __('Edit Truck') : __('Add Truck') }}
    </x-slot>
    <x-slot name="content">
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="merk" label="{{ __('Merk Truk') }}" required />
                <x-form-input name="merk" id="merk" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="merk"  autocomplete="merk" />
                <x-form-input-error for="merk" class="mt-2" />
            </div>
            <!-- kode perusahaan -->
            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="plat_nomor" label="{{ __('Plat Nomor') }}"  required />
                <x-form-input name="plat_nomor" id="plat_nomor" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="plat_nomor"  autocomplete="plat_nomor" />
                <x-form-input-error for="plat_nomor" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="warna" label="{{ __('Warna Mobil') }}"  required />
                <x-form-input name="warna" id="warna" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="warna"  autocomplete="warna" />
                <x-form-input-error for="warna" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 my-5">
                <x-form-label for="kapasitas" label="{{ __('Kapasitas Muatan') }}"  required />
                <x-form-input name="kapasitas" id="kapasitas" type="text" class="mt-1 rounded-md border border-gray-300 block w-full" wire:model="kapasitas"  autocomplete="kapasitas" />
                <x-form-input-error for="kapasitas" class="mt-2" />
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
