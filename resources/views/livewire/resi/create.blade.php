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

        @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        @vite(['resources/css/select2.min.css','resources/js/select2.min.js'])

        <script>
                 $(document).ready(function () {
                // Initialize Select2
                $('.form-select').select2();
            });
                $(document).ready(function() {
                    $('.form-select').select2();
                    $('.form-select').on('change', function(e) {
                        var data = $('.form-select').select2("val");
                        @this.set('selected', data);
                    });
                });
            // document.addEventListener('livewire:load', function() {
            //     Livewire.hook('message.processed', (message, component) => {
            //         // Initialize or reinitialize Select2 after Livewire update
            //         $('.form-select').select2();
            //     });

            //     // Initialize Select2 on page load
            //     $('.form-select').select2();
            //     // Trigger Livewire update when Select2 value changes
            //     $('.form-select').on('change', function(e) {
            //         // @this.set('tipe_muatan', e.target.value);
            //         var data = $('.form-select').select2("val");
            //         @this.set('selected', data);
            //     });
            // });

        </script>
      
        @endpush
    </x-innerpage-layout>
</div>
