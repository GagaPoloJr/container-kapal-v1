<div class="col-12">
    <div class="row">

        <!-- no resi -->
        <div class="col-12 col-md-6 mt-2">
            <x-form-label required='true' for="no_resi" label="{{ __('Nomor Resi') }}" />
            <x-form-input name="no_resi" id="no_resi" type="text" class="mt-1  block w-full" wire:model="no_resi" autocomplete="no_resi" />
            <x-form-input-error for="no_resi" class="mt-2" />
        </div>

        {{-- <!-- Name -->
        <div class="col-12 col-md-6 mt-2">
            <x-form-label required='true' for="nama_pengirim" label="{{ __('Nama Pengirim') }}" />
            <select wire:model="nama_pengirim" id="nama_pengirim" class="form-control form-select">
                <option selected>Pilih Pengirim</option>
                @foreach($customers as $key => $value)
                <option value="{{ $value->id }}">{{ $value->nama }}</option>
                @endforeach
            </select>
            <x-form-input-error for="nama_pengirim" class="mt-2" />
        </div> --}}

        <!-- kode perusahaan -->
        <div class="col-12 col-md-6 mt-2">
            <x-form-label required='true' for="nama_penerima" label="{{ __('Nama Pelanggan') }}" />
            <select wire:model="nama_penerima" id="pelanggan" class="form-control form-select">
                <option selected>Pilih Pelanggan</option>
                @foreach($customers as $key => $value)
                <option value="{{ $value->id }}">{{ $value->nama }}</option>
                @endforeach
            </select>
            <x-form-input-error for="nama_penerima" class="mt-2" />
        </div>

        <!-- trip tujuan -->
        <div class="col-12 col-md-6 mt-2">
            <x-form-label required='true' for="trip_ke" label="{{ __('Trip Tujuan') }}" />
            <x-form-input name="trip_ke" id="trip_ke" type="text" class="mt-1  block w-full" wire:model="trip_ke" autocomplete="trip_ke" />
            <x-form-input-error for="trip_ke" class="mt-2" />
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
        <!-- Name -->
        <div class="col-12 col-md-6">
            <x-form-label required='true' for="tgl_serah_barang" label="{{ __('Tanggal Serah Barang') }}" />
            <x-form-input name="tgl_serah_barang" id="tgl_serah_barang" type="date" class="mt-1  block w-full" wire:model="tgl_serah_barang" autocomplete="tgl_serah_barang" />
            <x-form-input-error for="tgl_serah_barang" class="mt-2" />
        </div>
        <div class="col-12 col-md-6">
            <x-form-label required='true' for="tipe_muatan" label="{{ __('Tipe Muatan') }}" />
            <select wire:model="tipe_muatan" id="tipe_muatan" class="form-control form-select">
                <option selected>Tipe Muatan</option>
                <option value="lcl">LCL</option>
                <option value="fcl">FCL</option>
               
            </select>
            <x-form-input-error for="tipe_muatan" class="mt-2" />
        </div>

    </div>

</div>
