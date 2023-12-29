<div>
    <!-- no container -->

    <div class="row">
        <div class="col-12 mt-2 col-md-4">
            <x-form-label required='true' for="nama_barang" label="{{ __('Nama Barang') }}" :required="true" />
            <x-form-input name="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.nama_barang" id="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.nama_barang" type="text" class="mt-1  block w-full" wire:model="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.nama_barang" autocomplete="nama_barang" />
            <x-form-input-error for="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.nama_barang" class="mt-2" />
        </div>
        <div class="col-12 mt-2 col-md-4">
            <x-form-label required='true' for="jml_barang" label="{{ __('Jumlah Barang') }}" :required="true" />
            <x-form-input name="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.jml_barang" id="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.jml_barang" type="text" class="mt-1  block w-full" wire:change="calculateJumlahKubikasi('{{ $formField['id'] }}', {{ $index }})" wire:model="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.jml_barang"  wire:model.debounce="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.jml_barang" />
            <x-form-input-error for="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.jml_barang" class="mt-2" />
        </div>

        <div class="col-12 mt-2 col-md-4">
            <x-form-label required='true' for="satuan_barang" label="{{ __('Satuan Barang') }}" :required="true" />
            <x-form-input name="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.satuan_barang" id="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.satuan_barang" type="text" class="mt-1  block w-full" wire:model="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.satuan_barang" autocomplete="satuan_barang" />
            <x-form-input-error for="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.satuan_barang" class="mt-2" />
        </div>

        <div class="col-12 mt-2 col-md-2">
            <x-form-label for="kg" label="{{ __('Kg') }}" />
            <x-form-input name="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.kg" id="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.kg" type="text" class="mt-1  block w-full" wire:model="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.kg" autocomplete="kg" />
            <x-form-input-error for="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.kg" class="mt-2" />
        </div>

        <div class="col-12 mt-2 col-md-2">
            <x-form-label required='true' for="p" label="{{ __('P') }}" :required="true" />
            <x-form-input name="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.p" id="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.p" type="text" class="mt-1  block w-full" wire:change="calculateJumlahKubikasi('{{ $formField['id'] }}', {{ $index }})" wire:model.debounce="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.p" autocomplete="p" />
            <x-form-input-error for="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.p" class="mt-2" />
        </div>

        <div class="col-12 mt-2 col-md-2">
            <x-form-label required='true' for="l" label="{{ __('L') }}" :required="true" />
            <x-form-input name="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.l" id="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.l" type="text" class="mt-1  block w-full" wire:change="calculateJumlahKubikasi('{{ $formField['id'] }}', {{ $index }})" wire:model.debounce="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.l" autocomplete="l" />
            <x-form-input-error for="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.l" class="mt-2" />
        </div>

        <div class="col-12 mt-2 col-md-2">
            <x-form-label required='true' for="t" label="{{ __('T') }}" :required="true" />
            <x-form-input name="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.t" id="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.t" type="text" class="mt-1  block w-full" wire:change="calculateJumlahKubikasi('{{ $formField['id'] }}', {{ $index }})" wire:model.debounce="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.t" autocomplete="t" />
            <x-form-input-error for="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.t" class="mt-2" />
        </div>

        <div class="col-12 mt-2 col-md-3">
            <x-form-label required='true' for="jumlah_kubikasi" label="{{ __('Jumlah Kubikasi') }}" :required="true" />
            <x-form-input readonly  name="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.jumlah_kubikasi" id="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.jumlah_kubikasi" type="text" class="mt-1  block w-full bg-gray-500" wire:model.defer="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.jumlah_kubikasi" autocomplete="jumlah_kubikasi" />
            <x-form-input-error for="barangFields.{{ $formField['id'] }}.{{ $loop->index }}.attributes.jumlah_kubikasi" class="mt-2" />
        </div>

        {{-- <div class="col-12 mt-2 col-md-2">
            <p class="mt-2">{{ $this->getJumlahKubikasi($formField['id'], $loop->index) }}</p>
        </div> --}}
    </div>


    {{-- <button type="button" wire:click="removeBarangField('{{ $formField['id'] }}', '{{ $barangField['id'] }}')">Remove</button> --}}
</div>
