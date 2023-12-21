<x-innerpage-layout>
    <x-slot name="header">
        <x-slot name="title">
            {{ __('Dashboard') }}
        </x-slot>

        <x-slot name="subtitle">
            {{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}
        </x-slot>
        <x-slot name="action">

            {{-- modal action --}}
            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                data-bs-target="#modal-report">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Create new report
            </a>
            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                data-bs-target="#modal-report" aria-label="Create new report">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
            </a>
        </x-slot>
    </x-slot>
    <div class="row row-cards">
        <div class="col-span-6 sm:col-span-4">
            <x-form-label required for="name" label="{{ __('Name') }}" />
            <x-form-input id="name" type="text" wire:model="state.name" required autocomplete="name" />
            <x-form-input-error for="name" class="mt-2" />
        </div>
    </div>

    @push('modals')
        <x-modal-custom id="modal-report">

            <x-slot name="title">
                {{ __('Modal Report aja') }}
            </x-slot>

        </x-modal-custom>
    @endpush
</x-innerpage-layout>
