<div class="col-12">
    <div class="row">

        <!-- no resi -->
        <div class="col-12 col-md-6 mt-2">
            <x-form-label required='true' for="no_resi" label="{{ __('Nomor Resi') }}" />
            <x-form-input name="no_resi" id="no_resi" type="text" class="mt-1  block w-full" wire:model="no_resi" autocomplete="no_resi" />
            <x-form-input-error for="no_resi" class="mt-2" />
        </div>
        <!-- kode perusahaan -->
        <div class="col-12 col-md-6 mt-2 position-relative">
            <x-form-label required='true' for="nama_penerima" label="{{ __('Nama Penerima') }}" />
            <livewire:select-dropdown-search :value_id="$nama_penerima" modelValue="nama_penerima" wire:model="nama_penerima" searchAttribute="nama" placeholder="Nama Penerima" :options="$customers" :selectedItem="$selectedItem" />
            <x-form-input-error for="nama_penerima" class="mt-2" />
        </div>

        <!-- trip tujuan -->
        <div class="col-12 col-md-6  mt-2">
            <x-form-label required='true' for="trip_tujuan" label="{{ __('Trip Ke Berapa') }}" />
            <x-form-input name="trip_tujuan" id="trip_tujuan" type="text" class="mt-1  block w-full" wire:model="trip_tujuan" autocomplete="trip_tujuan" />
            <x-form-input-error for="trip_tujuan" class="mt-2" />
        </div>
        <div class="col-12 col-md-6  mt-2">
            <x-form-label required='true' for="kapal_muatan" label="{{ __('Kapal Muatan') }}" />
            <x-form-input name="kapal_muatan" id="kapal_muatan" type="text" class="mt-1  block w-full" wire:model="kapal_muatan" autocomplete="kapal_muatan" />
            <x-form-input-error for="kapal_muatan" class="mt-2" />
        </div>

        <!-- kota keberangkatan -->
        <div class="col-12 col-md-6 mt-2">
            <x-form-label required='true' for="kota_keberangkatan" label="{{ __('Kota Keberangkatan') }}" />
            <x-form-input name="kota_keberangkatan" id="kota_keberangkatan" type="text" class="mt-1  block w-full" wire:model="kota_keberangkatan" autocomplete="kota_keberangkatan" />
            <x-form-input-error for="kota_keberangkatan" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="col-12 col-md-6 mt-2">
            <x-form-label required='true' for="kota_tujuan" label="{{ __('Kota Tujuan') }}" />
            <x-form-input name="kota_tujuan" id="kota_tujuan" type="text" class="mt-1  block w-full" wire:model="kota_tujuan" autocomplete="kota_tujuan" />
            <x-form-input-error for="kota_tujuan" class="mt-2" />
        </div>
        <!-- divider -->
        <div class="col-12 my-5">
            <hr>
        </div>

        <div class="col-12 col-md-6">
            <x-form-label required='true' for="tgl_berangkat" label="{{ __('Tanggal Berangkat') }}" />
            <x-form-input name="tgl_berangkat" id="tgl_berangkat" type="date" class="mt-1  block w-full" wire:model="tgl_berangkat" autocomplete="tgl_berangkat" />
            <x-form-input-error for="tgl_berangkat" class="mt-2" />
        </div>
        <div class="col-12 col-md-6">
            <x-form-label required='true' for="tipe_muatan" label="{{ __('Tipe Muatan') }}" />
            <select wire:model="tipe_muatan" id="tipe_muatan" wire:change="validateTipeMuatan" class="form-control form-select">
                <option selected>Tipe Muatan</option>
                <option value="lcl">LCL</option>
                <option value="fcl">FCL</option>

            </select>
            <x-form-input-error for="tipe_muatan" class="mt-2" />
        </div>

    </div>

</div>
