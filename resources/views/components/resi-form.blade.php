<div>
    <!-- no resi -->
    <div class="col-span-12 md:col-span-2">
        <x-form-label required='true' for="no_resi" label="{{ __('Nomor Resi') }}"  />
        <x-form-input name="no_resi" id="no_resi" type="text" class="mt-1  block w-full" wire:model="no_resi" autocomplete="no_resi" />
        <x-form-input-error for="no_resi" class="mt-2" />
    </div>

    <!-- Name -->
    <div class="col-span-12 md:col-span-2">

        <x-form-label required='true' for="nama_pengirim" label="{{ __('Nama Pengirim') }}" />
        <x-form-input readonly="true" value=" {{ $nama_pengirim }}" name="nama_pengirim" id="nama_pengirim" type="text" class="mt-1 block w-full" wire:model="nama_pengirim" autocomplete="nama_pengirim" />
        <x-form-input-error for="nama_pengirim" class="mt-2" />
    </div>

    <!-- kode perusahaan -->
    <div class="col-span-12 md:col-span-2">
        <x-form-label required='true' for="nama_pelanggan" label="{{ __('Nama Pelanggan') }}" />
        <select wire:model="nama_pelanggan" id="pelanggan" class="mt-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            <option selected>Pilih Pelanggan</option>
            @foreach($customers as $key => $value)
            <option value="{{ $value->id }}">{{ $value->nama }}</option>
            @endforeach
        </select>
        <x-form-input-error for="nama_pelanggan" class="mt-2" />
    </div>

    <!-- trip tujuan -->
    <div class="col-span-12 md:col-span-2">
        <x-form-label required='true' for="trip_ke" label="{{ __('Trip Tujuan') }}" />
        <x-form-input name="trip_ke" id="trip_ke" type="text" class="mt-1  block w-full" wire:model="trip_ke" autocomplete="trip_ke" />
        <x-form-input-error for="trip_ke" class="mt-2" />
    </div>

    <!-- kota keberangkatan -->
    <div class="col-span-12 md:col-span-2">
        <x-form-label required='true' for="kota_keberangkatan" label="{{ __('Kota Keberangkatan') }}" />
        <x-form-input name="kota_keberangkatan" id="kota_keberangkatan" type="text" class="mt-1  block w-full" wire:model="kota_keberangkatan" autocomplete="kota_keberangkatan" />
        <x-form-input-error for="kota_keberangkatan" class="mt-2" />
    </div>

    <!-- Name -->
    <div class="col-span-12 md:col-span-2">
        <x-form-label required='true' for="kota_tujuan" label="{{ __('Kota Tujuan') }}" />
        <x-form-input name="kota_tujuan" id="kota_tujuan" type="text" class="mt-1  block w-full" wire:model="kota_tujuan" autocomplete="kota_tujuan" />
        <x-form-input-error for="kota_tujuan" class="mt-2" />
    </div>


    <!-- divider -->
    <div class="col-span-12 md:col-span-6 my-5">
        <hr>
    </div>

    <div class="col-span-12 md:col-span-3">
        <x-form-label required='true' for="tgl_berangkat" label="{{ __('Tanggal Berangkat') }}" />
        <x-form-input name="tgl_berangkat" id="tgl_berangkat" type="date" class="mt-1  block w-full" wire:model="tgl_berangkat" autocomplete="tgl_berangkat" />
        <x-form-input-error for="tgl_berangkat" class="mt-2" />
    </div>
    <!-- Name -->
    <div class="col-span-12 md:col-span-3">
        <x-form-label required='true' for="tgl_serah_barang" label="{{ __('Tanggal Serah Barang') }}" />
        <x-form-input name="tgl_serah_barang" id="tgl_serah_barang" type="text" class="mt-1  block w-full" wire:model="tgl_serah_barang" autocomplete="tgl_serah_barang" />
        <x-form-input-error for="tgl_serah_barang" class="mt-2" />
    </div>
</div>