<div>
    <x-innerpage-layout>
        @section('title', 'Settings')
        <x-slot name="header">
            <x-slot name="title">
                {{ __('Settings') }}
            </x-slot>

            <x-slot name="subtitle">
                {{ __('Update configuration.') }}
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
                            <x-form-label for="nama_perusahaan" label="{{ __('Nama Perusahaan') }}" />
                            <x-form-input name="a" id="nama_perusahaan" type="text" class="mt-1 block w-full" wire:model="state.nama_perusahaan" autocomplete="nama_perusahaan" />
                            <x-form-input-error for="state.nama_perusahaan" class="mt-2" />
                        </div>
                        <!-- kode perusahaan -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="kode_perusahaan" label="{{ __('Kode Perusahaan') }}" />
                            <x-form-input name="a" id="kode_perusahaan" type="text" class="mt-1 block w-full" wire:model="state.kode_perusahaan" autocomplete="kode_perusahaan" />
                            <x-form-input-error for="state.kode_perusahaan" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="email" label="{{ __('Email') }}" />
                            <x-form-input name="a" id="email" type="email" class="mt-1 block w-full" wire:model="state.email" autocomplete="username" />
                            <x-form-input-error for="state.email" class="mt-2" />
                        </div>

                        <!-- lini bisnis -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="lini_bisnis" label="{{ __('Lini Bisnis') }}" />
                            <x-form-input name="a" id="lini_bisnis" type="text" class="mt-1 block w-full" wire:model="state.lini_bisnis" autocomplete="lini_bisnis" />
                            <x-form-input-error for="state.lini_bisnis" class="mt-2" />
                        </div>
                        <!-- nomor -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="phone" label="{{ __('Nomor') }}" />
                            <x-form-input name="a" id="phone" type="text" class="mt-1 block w-full" wire:model="state.phone" autocomplete="phone" />
                            <x-form-input-error for="state.phone" class="mt-2" />
                        </div>

                        <!-- fax -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="fax" label="{{ __('Fax') }}" />
                            <x-form-input name="a" id="fax" type="text" class="mt-1 block w-full" wire:model="state.fax" required autocomplete="fax" />
                            <x-form-input-error for="state.fax" class="mt-2" />
                        </div>

                        <!-- alamat -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-form-label for="alamat" label="{{ __('Alamat') }}" />
                            <x-form-input name="a" id="alamat" type="text" class="mt-1 block w-full" wire:model="state.alamat" autocomplete="alamat" />
                            <x-form-input-error for="state.alamat" class="mt-2" />
                        </div>

                    </x-slot>

                    <x-slot name="actions">
                        <x-action-message class="me-3" on="saved">
                            {{ __('Saved.') }}
                        </x-action-message>

                        <x-button-cst wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-button-cst>
                    </x-slot>
                </x-form-custom>
            </div>

            <div class="col-12 pt-6 pb-12">
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
            </div>
        </div>

    </x-innerpage-layout>

</div>
