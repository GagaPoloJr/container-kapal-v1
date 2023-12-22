<div>
    <x-innerpage-layout>
        @section('title', 'Edit User')
        <x-slot name="header">
            <x-slot name="title">
                {{ __('Edit User') }}
            </x-slot>

            <x-slot name="subtitle">
                {{ __('Update User.') }}
            </x-slot>
        </x-slot>

        <div class="row row-cards">
            <div class="col-12">
                <x-form-custom submit="updateProfileInformation">
                    <x-slot name="title">
                        {{ __('General Information') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Update your account\'s settings information.') }}

                    </x-slot>
                    <x-slot name="form">
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="name" label="{{ __('Nama Lengkap') }}" />
                            <x-form-input name="name" id="name" type="text" class="mt-1 block w-full" wire:model="name" autocomplete="name" />
                            <x-form-input-error for="name" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="email" label="{{ __('Email') }}" />
                            <x-form-input name="email" id="email" type="email" class="mt-1 block w-full" wire:model="email" autocomplete="email" />
                            <x-form-input-error for="email" class="mt-2" />
                        </div>
                    </x-slot>

                    <x-slot name="actions" class="justify-content-end">


                        <x-button-cst wire:loading.attr="disabled" class="">
                            {{ __('Save') }}
                        </x-button-cst>
                        <x-action-message class="me-3" on="saved">
                            {{ __('Saved.') }}
                        </x-action-message>
                    </x-slot>
                </x-form-custom>
            </div>

            <div class="col-12">
                <x-form-custom submit="updatePassword">
                    <x-slot name="title">
                        {{ __('Password') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Update your account\'s password information.') }}

                    </x-slot>
                    <x-slot name="form">
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="password" label="{{ __('Password') }}" />
                            <x-form-input name="password" id="password" type="password" wire:model="password" class="mt-1 block w-full"   />
                            <x-form-input-error for="password" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="cpassword" label="{{ __('Confirm Password') }}" />
                            <x-form-input name="cpassword" id="cpassword" type="password" wire:model="password_confirmation" class="mt-1 block w-full" />
                            <x-form-input-error for="cpassword" class="mt-2" />
                        </div>
                    </x-slot>

                    <x-slot name="actions" class="justify-content-end">


                        <x-button-cst wire:loading.attr="disabled" class="">
                            {{ __('Save') }}
                        </x-button-cst>
                        <x-action-message class="me-3" on="saved_pass">
                            {{ __('Saved.') }}
                        </x-action-message>
                    </x-slot>
                </x-form-custom>
            </div>


            {{-- <div class="col-12 pt-6 pb-12">
                <x-form-custom submit="updateBankAndNpwpInformation">
                    <x-slot name="title">
                        {{ __('Bank & NPWP Information') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Update your account\'s bank & NPWP information.') }}

            </x-slot>
            <x-slot name="form">
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-form-label for="npwp" value="{{ __('NPWP') }}" />
                    <x-form-input name="a" id="npwp" type="text" class="mt-1 block w-full" wire:model="state.npwp" required autocomplete="npwp" />
                    <x-form-input-error for="state.npwp" class="mt-2" />
                </div>
                <!-- kode perusahaan -->
                <div class="col-span-6 sm:col-span-4">
                    <x-form-label for="no_rek_1" value="{{ __('Nomor Rekening Satu') }}" />
                    <x-form-input name="a" id="no_rek_1" type="text" class="mt-1 block w-full" wire:model="state.no_rek_1" required autocomplete="no_rek_1" />
                    <x-form-input-error for="state.no_rek_1" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-form-label for="no_rek_2" value="{{ __('Nomor Rekening Dua') }}" />
                    <x-form-input name="a" id="no_rek_2" type="text" class="mt-1 block w-full" wire:model="state.no_rek_2" required autocomplete="no_rek_2" />
                    <x-form-input-error for="state.no_rek_2" class="mt-2" />
                </div>


            </x-slot>

            <x-slot name="actions">
                <x-action-message class="me-3" on="saved_bank">
                    {{ __('Saved.') }}
                </x-action-message>

                <x-button-cst wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button-cst>
            </x-slot>
            </x-form-custom>
        </div>
        <div class="col-12 pt-6 pb-12">
            <x-form-custom submit="updateSignInformation" typeSubmit="file">
                <x-slot name="title">
                    {{ __('Sign Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Update your account\'s Sign information.') }}

                </x-slot>
                <x-slot name="form">
                    <!-- Name -->
                    <div x-data="{ photoPreview: null }" x-init="
                            $watch('photoPreview', value => {
                                if (value !== null) {
                                    Alpine.start();
                                }
                            })" class="col-span-6 sm:col-span-4">
                        <x-form-label for="ttd_kwitansi" value="{{ __('TTD Kwitansi') }}" />
                        <x-form-input name="a" id="ttd_kwitansi" type="file" class="mt-1 block w-full" wire:model="state.ttd_kwitansi" wire:model.live="state.ttd_kwitansi" x-ref="state.ttd_kwitansi" x-on:change="
                                        photoName = $refs.ttd_kwitansi.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.ttd_kwitansi.files[0]);
                                " />

                        <div wire:loading wire:target="ttd_kwitansi">Uploading...</div>
                        <x-form-input-error for="state.ttd_kwitansi" class="mt-2" />

                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ asset('storage/'.$state['ttd_kwitansi']) }}" alt="ttd" class="rounded-full h-20 w-20 object-cover">
                        </div>
                    </div>
                    <!-- kode perusahaan -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-form-label for="ttd_resi" value="{{ __('TTD Resi') }}" />
                        <x-form-input name="a" id="ttd_resi" type="file" class="mt-1 block w-full" wire:model="state.ttd_resi" autocomplete="ttd_resi" />
                        <div wire:loading wire:target="state.ttd_resi">Uploading...</div>
                        <x-form-input-error for="state.ttd_resi" class="mt-2" />

                        @if ($state['ttd_resi'])
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$state['ttd_resi']) }}" alt="TTD Resi" class="max-w-full h-auto" />
                        </div>
                        @endif
                    </div>
                </x-slot>

                <x-slot name="actions">
                    <x-action-message class="me-3" on="saved_sign">
                        {{ __('Saved.') }}
                    </x-action-message>

                    <x-button-cst wire:loading.attr="disabled" wire:target="photo">
                        {{ __('Save') }}
                    </x-button-cst>
                </x-slot>
            </x-form-custom>
        </div> --}}
</div>

</x-innerpage-layout>

</div>
