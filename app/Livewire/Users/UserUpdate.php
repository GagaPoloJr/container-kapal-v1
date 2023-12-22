<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserUpdate extends Component
{
    public $state, $name, $email, $user_id, $password,$password_confirmation;
    public $createAccountError;
    public $typeSubmit;


    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->state = [
            'name' => $user->name,
            'email' => $user->email,

        ];
    }
    public function render()
    {
        return view('livewire.users.edit');
    }

    public function validateProfileInformation()
    {
        return $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);
    }

    public function validatePassword()
    {
        return $this->validate([
            'password' => ['required', 'confirmed', new Password],
        ]);
    }

    public function updateProfileInformation()
    {
        
        $validatedData = $this->validateProfileInformation();
        $update = User::where('id', $this->user_id)->update($validatedData);
        if ($update) {
            $this->dispatch('saved'); // Trigger the "saved" event for a success message
            $this->dispatch('notify', title: 'success', message: 'Data profil berhasil di update');
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => ['required', 'confirmed', new Password],
        ]);

        $update = User::where('id', $this->user_id)->update(['password' => Hash::make($this->password)]);
        if ($update) {
            $this->reset(['password', 'password_confirmation']);

            $this->dispatch('saved_pass'); // Trigger the "saved" event for a success message
            $this->dispatch('notify', title: 'success', message: 'Data profil berhasil di update');
        }
    }
}
