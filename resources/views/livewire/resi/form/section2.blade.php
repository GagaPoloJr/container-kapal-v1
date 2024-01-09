<div class="col-12">
    @foreach ($formFields as $key => $formField)
    <div class="mt-5 row-cards">
        <div class="col-12">
            <div class="position-relative card">
                @if($key !== 0)
                <div class="position-absolute right-0 top-0 z-index-99 p-2">
                    <button title="remove container field" type="button" class="btn btn-danger" wire:click="removeFormField('{{ $formField['id'] }}')">
                        <x-heroicon-s-trash class="w-4 h-4 p-1 btn-danger" />
                    </button>
                </div>
                @endif
                <div class="card-body">
                    <div class="card-title">
                        Container {{++$key }}
                    </div>
                    <div class="row">
                        <div class="col-12 row">
                            <!-- no container -->
                            <div class="col-12 col-md-6">
                                <x-form-label required='true' for="no_container" label="{{ __('Nomor Container') }}" :required="true" />
                                <x-form-input name="formFields.{{ $loop->index }}.attributes.no_container" id="formFields.{{ $loop->index }}.attributes.no_container" type="text" class="mt-1  block w-full" wire:model="formFields.{{ $loop->index }}.attributes.no_container" autocomplete="no_container" />
                                <x-form-input-error for="formFields.{{ $loop->index }}.attributes.no_container" class="mt-2" />
                            </div>

                            <div class="col-12 col-md-6">
                                <x-form-label required='true' for="no_seal" label="{{ __('Nomor Seal') }}" :required="true" />
                                <x-form-input name="formFields.{{ $loop->index }}.attributes.no_seal" id="formFields.{{ $loop->index }}.attributes.no_seal" type="text" class="mt-1  block w-full" wire:model="formFields.{{ $loop->index }}.attributes.no_seal" autocomplete="no_seal" />
                                <x-form-input-error for="formFields.{{ $loop->index }}.attributes.no_seal" class="mt-2" />
                            </div>

                            <div class="col-12 col-md-6 mt-2  position-relative">
                                <x-form-label required='true' for="asal_barang" label="{{ __('Nama Pengirim') }}" :required="true" />

                                <livewire:select-dropdown-search :value_id="$formFields[$loop->index]['attributes']['asal_barang']" :wire:key="$loop->index" modelValue="formFields.{{ $loop->index }}.attributes.asal_barang" wire:model="formFields.{{ $loop->index }}.attributes.asal_barang" id="formFields.{{ $loop->index }}.attributes.asal_barang" searchAttribute="nama" placeholder="Nama Pengirim" :options="$customers" :selectedItem="$selectedItem" />
                                <x-form-input-error for="formFields.{{ $loop->index }}.attributes.asal_barang" class="mt-2" />
                            </div>

                            <div class="col-12 col-md-6 mt-2">
                                <x-form-label required='true' for="tgl_serah_barang" label="{{ __('Tanggal Serah Barang') }}" :required="true" />
                                <x-form-input name="formFields.{{ $loop->index }}.attributes.tgl_serah_barang" id="formFields.{{ $loop->index }}.attributes.tgl_serah_barang" type="date" class="mt-1  block w-full" wire:model="formFields.{{ $loop->index }}.attributes.tgl_serah_barang" autocomplete="tgl_serah_barang" />
                                <x-form-input-error for="formFields.{{ $loop->index }}.attributes.tgl_serah_barang" class="mt-2" />
                            </div>

                            <div>
                                <div class="row-cards mt-5">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title">
                                                    Barang
                                                </div>
                                                @foreach ($barangFields[$formField['id']] as $index => $barangField)
                                                <div class="row align-items-center align-items-lg-end">
                                                    <div class="col-10 mt-5">
                                                        {{-- fields barang --}}
                                                        @include('livewire.resi.form.section3')
                                                    </div>

                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-danger" wire:click="removeBarangField('{{ $formField['id'] }}', '{{ $barangField['id'] }}')">
                                                            <x-heroicon-s-trash class="w-4 h-4 p-1 btn-danger" />
                                                        </button>
                                                    </div>
                                                </div>

                                                @endforeach
                                                <div class="col-6 mt-5">
                                                    <button type="button" class="btn btn-info" wire:click="addBarangField('{{ $formField['id'] }}')" wire:loading.attr="disabled">
                                                        <x-heroicon-s-plus class="w-4 h-4 p-1  btn-info" /> Barang
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach
    <div class="col-2 mt-5">
        <button type="button" class="btn btn-primary" wire:click="addFormField">Add Container Field</button>
    </div>
</div>


{{-- @push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@vite(['resources/css/select2.min.css','resources/js/select2.min.js'])

<script>
    $(document).ready(function() {
        $('.form-select').select2();
        $('.form-select').on('change', function(e) {
            var data = $('.form-select').select2("val");
            @this.set('selected', data);
        });
    });

</script>

@endpush --}}
