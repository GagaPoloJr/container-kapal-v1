<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    // public $nama_perusahaan, $kode_perusahaan, $lini_bisnis, $email, $phone, $fax, $alamat, $npwp, $ttd_resi, $ttd_kwitansi, $no_rek_1, $no_rek_2;
    public $state;
    public $createAccountError;
    public $typeSubmit;
    use WithFileUploads;
    public function mount()
    {
        $setting = Setting::findOrFail(1);

        $this->state = [
            'nama_perusahaan' => $setting->nama_perusahaan,
            'kode_perusahaan' => $setting->kode_perusahaan,
            'lini_bisnis' => $setting->lini_bisnis,
            'email' => $setting->email,
            'phone' => $setting->phone,
            'fax' => $setting->fax,
            'alamat' => $setting->alamat,
            'npwp' => $setting->npwp,
            'ttd_resi' => $setting->ttd_resi,
            'ttd_kwitansi' => $setting->ttd_kwitansi,
            'no_rek_1' => $setting->no_rek_1,
            'no_rek_2' => $setting->no_rek_2,
        ];
    }

    public function render()
    {
        return view('livewire.settings.index');
    }

    public function validateProfileInformation()
    {
        return $this->validate([
            'state.nama_perusahaan' => 'required|max:50',
            'state.kode_perusahaan' => 'required|max:10',
            'state.email' => 'required|email|max:255',
            'state.lini_bisnis' => 'required|max:255',
            'state.phone' => 'required|max:20',
            'state.fax' => 'required|max:15',
            'state.alamat' => 'required|max:255',
        ]);
    }
    public function validateSignInformation()
    {
        return $this->validate([
            'state.ttd_kwitansi' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);
    }

    /**
     * return an aliases each of field
     */
    // protected function formatValidationErrors($errors)
    // {
    //     return collect($errors)->mapWithKeys(function ($message, $key) {
    //         return [$key => str_replace([':attribute'], [str_replace('state.', '', $key)], $message)];
    //     })->toArray();
    // }


    /**
     * func
     */
    public function updateProfileInformation()
    {
        $validatedData = $this->validateProfileInformation();
        $update = Setting::where('id', 1)->update($validatedData['state']);
        if ($update) {
            $this->dispatch('saved'); // Trigger the "saved" event for a success message
            $this->dispatch('notify', title: 'success', message: 'Data profil berhasil di update');
        }
    }

    public function updateBankAndNpwpInformation()
    {
        $update = Setting::where('id', 1)->update([
            'npwp' => $this->state['npwp'],
            'no_rek_1' => $this->state['no_rek_1'],
            'no_rek_2' => $this->state['no_rek_2'],
        ]);
        if ($update) {
            $this->dispatch('saved_bank');
            $this->dispatch('notify', title: 'success', message: 'Data bank berhasil di update');
        }


    }

    public function updateSignInformation()
    {

        $validatedData = $this->validateSignInformation();
        if ($this->state['ttd_kwitansi']) {
            $validatedData['state']['ttd_kwitansi'] = $this->state['ttd_kwitansi']->store('kwitansi', 'public');
        }
        $update = Setting::where('id', 1)->update($validatedData['state']);
        if ($update) {
            $this->dispatch('saved_sign'); // Trigger the "saved" event for a success message
            $this->dispatch('notify', title: 'success', message: 'Data tanda tangan berhasil di update');

        }
    }

}
