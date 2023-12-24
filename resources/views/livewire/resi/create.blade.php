<div>
    <x-innerpage-layout>

        @section('title', 'Create Pencatatan Resi')
        <x-slot name="header">
            <x-slot name="title">
                {{ __('Pencatatan Resi') }}
            </x-slot>

            <x-slot name="subtitle">
                {{ __('Create a new pencatatan resi.') }}
            </x-slot>

        </x-slot>

        <div class="row row-cards">
            <x-form-custom submit="store">
                <x-slot name="title">
                    {{ __('Pencatatan Resi') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Resi.') }}

                </x-slot>

                <x-slot name="form">
                    @include('livewire.resi.form.section1')
                    @include('livewire.resi.form.section2')
                </x-slot>

                <x-slot name="actions">
                    <x-button-cst wire:loading.attr="disabled" class="">
                        {{ __('Create') }}
                    </x-button-cst>
                </x-slot>


            </x-form-custom>

        </div>
    </x-innerpage-layout>
</div>
