<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserPost extends Component
{

    public $name, $email, $password,$password_confirmation;

    public function mount(){

    }


    public function render()
    {
        return view('livewire.users.create');
    }


    public function resetCreateForm(){
        $this->name= "";
        $this->email= "";
        $this->password= "";
        $this->password_confirmation= "";
    }
    /**
     * Store or update a user record.
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        try {
            User::updateOrCreate(['id' => $this->role_id], [
                'name' => $this->name,
            ]);

            if ($this->isUpdatePage) {
                $this->dispatch('notify', title: 'success', message: 'Data role berhasil di ubah');
            } else {
                $this->dispatch('notify', title: 'success', message: 'Data role berhasil ditambahkan');
            }
            $this->resetCreateForm();
            $this->dispatch('dispatch-roles-table');
        } catch (ValidationException $e) {
            $this->dispatch('notify', title: 'error', message: $e->validator->errors());
        } catch (\Exception $e) {
            $this->dispatch('notify', title: 'error', message: 'An error occurred while saving the data.');
        }
    }

}