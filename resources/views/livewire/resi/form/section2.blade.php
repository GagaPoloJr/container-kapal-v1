<div class="col-12">

    @foreach ($formFields as $formField)
    <div class=" row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Container {{$loop->index }}
                    </div>
                    <div class="row">

                        <div class="col-12 row">
                            <!-- Your form fields go here -->
                            {{-- Form Field: {{ $formField['id'] }} --}}
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

                            <div class="col-12 col-md-6">
                                <x-form-label required='true' for="asal_barang" label="{{ __('Nama Pengirim') }}" :required="true" />
                                {{-- <x-form-input name="formFields.{{ $loop->index }}.attributes.asal_barang" id="formFields.{{ $loop->index }}.attributes.asal_barang" type="text" class="mt-1 block w-full" wire:model="formFields.{{ $loop->index }}.attributes.asal_barang" autocomplete="asal_barang" /> --}}
                                <select wire:model="formFields.{{ $loop->index }}.attributes.asal_barang" id="formFields.{{ $loop->index }}.attributes.asal_barang" class="form-control form-select">
                                    <option selected>Pilih Pengirim</option>
                                    @foreach($customers as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                    @endforeach
                                </select>
                                <x-form-input-error for="formFields.{{ $loop->index }}.attributes.asal_barang" class="mt-2" />


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
                                                <div class="col-span-12 md:col-span-2 mt-5">
                                                    {{-- <!-- Your barang fields go here -->
                                                    Barang Field: {{ $barangField['id'] }} --}}
                                                    @include('livewire.resi.form.section3')
                                                </div>

                                                <div class="col-6">
                                                    <button type="button" class="btn btn-danger" wire:click="removeBarangField('{{ $formField['id'] }}', '{{ $barangField['id'] }}')">Remove</button>
                                                </div>
                                                @endforeach
                                                <div class="col-6 mt-5">
                                                    <button type="button" class="btn btn-info" wire:click="addBarangField('{{ $formField['id'] }}')" wire:loading.attr="disabled">Add Barang</button>
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
    <div class="row justify-content-end mb-4">
        <div class="col-12">
            <button type="button" class="btn btn-danger" wire:click="removeFormField('{{ $formField['id'] }}')">Remove Container Field</button>
        </div>
    </div>
    @endforeach
    <div class="col-2 mt-5">
        <button type="button" class="btn btn-primary" wire:click="addFormField">Add Container Field</button>
    </div>
</div>
