<?php

namespace App\Livewire;

use App\Models\ExtendedPermission;
use App\Models\ExtendedRole;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public $createAccountError;
    public $typeSubmit;
    public $name,$email, $user_id, $state;
    public $isModalOpen = false;
    public $isModalDelete = false;
    public $isUpdatePage = false;
    public $page = 1;
    public $perPage = 10;
    public $search = '';
    public $sortDirection = 'DESC';
    public $sortColumn = 'created_at';
    public $confirmDeleteId;
    public $title = 'Default Page Title';
    /**
     * Toggle sort direction when column header is clicked.
     *
     * @param string $column
     * @return void
     */
    public function doSort($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = ($this->sortDirection === 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortColumn = $column;
        $this->sortDirection = 'ASC';
    }

    /**
     * Store the current page when updating.
     *
     * @param int $page
     * @return void
     */
    public function updatingPage($page)
    {
        $this->page = $page ?: 1;
        // $this->page = $this->page ?: 1;
    }

    /**
     * Save the current page to the session.
     *
     * @return void
     */
    public function updatedPage()
    {
        session(['page' => $this->page]);
    }

    /**
     * Initialize component with stored page or default values.
     *
     * @return void
     */
    #[On('dispatch-roles-table')]
    public function mount()
    {
      
        if (session()->has('page')) {
            $this->page = session('page');
        }

    }

    /**
     * Render the data on the truck table.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $columns = [
            ['label' => 'Nama', 'column' => 'name', 'isData' => true],
            ['label' => 'Email', 'column' => 'email', 'isData' => true],
            ['label' => 'Created', 'column' => 'created_at', 'isData' => true],
            ['label' => 'Action', 'column' => 'action', 'isData' => false],
        ];

        $users = User::search($this->search)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage, ['*'], 'page');

        return view('livewire.users.index', compact('users', 'columns'));
    }

    public function customFormat($column, $data)
    {
        switch ($column) {
            case 'created_at':
                $parsedDate = \Carbon\Carbon::parse($data);
                return $parsedDate->diffForHumans();
            case 'warna':
                return '<span class="bg-blue-500">' . $data . '</span>';
            default:
                return $data;
        }
    }

    /**
     * Confirm the creation of a new truck.
     *
     * @return void
     */
    public function confirmCreate()
    {
        $this->isUpdatePage = false;
        $this->openModalPopover();
    }

    /**
     * Open the modal popover based on the provided ID.
     *
     * @param int|null $id
     * @return void
     */
    public function openModalPopover($id = null)
    {
        if ($id) {
            $this->confirmDeleteId = $id;
            $this->isModalDelete = true;
        } else {
            $this->isModalOpen = true;
        }
    }

    /**
     * Close the modal popover.
     *
     * @return void
     */
    public function closeModalPopover()
    {
        $this->isModalDelete = false;
        $this->isModalOpen = false;
        $this->resetCreateForm();
    }

    /**
     * Reset the form for creating a new truck.
     *
     * @return void
     */
    private function resetCreateForm()
    {
        $this->truck_id = '';
        $this->merk = '';
        $this->plat_nomor = '';
        $this->warna = '';
        $this->kapasitas = '';
    }

    /**
     * Store or update a truck record.
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
            ExtendedRole::updateOrCreate(['id' => $this->role_id], [
                'name' => $this->name,
            ]);

            if ($this->isUpdatePage) {
                $this->dispatch('notify', title: 'success', message: 'Data role berhasil di ubah');
            } else {
                $this->dispatch('notify', title: 'success', message: 'Data role berhasil ditambahkan');
            }
            $this->closeModalPopover();
            $this->resetCreateForm();
            $this->dispatch('dispatch-roles-table');
        } catch (ValidationException $e) {
            $this->dispatch('notify', title: 'error', message: $e->validator->errors());
        } catch (\Exception $e) {
            $this->dispatch('notify', title: 'error', message: 'An error occurred while saving the data.');
        }
    }

    /**
     * Edit an existing truck record.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $this->isUpdatePage = true;
        $role = ExtendedRole::findOrFail($id);
        $this->role_id = $id;
        $this->name = $role->name;
        $this->openModalPopover();
    }

    /**
     * Initiate delete confirmation process.
     *
     * @param int $id
     * @return void
     */
    public function deleteConfirmation($id)
    {
        $this->confirmDeleteId = $id;
        $this->openModalPopover($id);
    }

    /**
     * Delete a truck record.
     *
     * @return void
     */
    public function delete()
    {
        try {
            $users = ExtendedRole::findOrFail($this->confirmDeleteId);
            $users->delete();
            $this->dispatch('notify', title: 'success', message: 'Data Role ' . $users->name . ' berhasil dihapus');
            $this->closeModalPopover();
            $this->search = ''; // Reset search after successful delete
            $this->dispatch('dispatch-roles-table');
        } catch (\Exception $e) {
            $this->dispatch('notify', title: 'error', message: 'An error occurred while deleting the data.');
        }
    }

    public function editPage($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->state = [
            'name' => $user->name,
            'email' => $user->email,
           
        ];
        return view('livewire.users.edit');
    }

    public function validateProfileInformation()
    {
        return $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);
    }

    public function updateProfileInformation($id)
    {
        $id = $this->user_id;
        $validatedData = $this->validateProfileInformation();
        $update = User::where('id', $id)->update($validatedData['state']);
        if ($update) {
            $this->dispatch('saved'); // Trigger the "saved" event for a success message
            $this->dispatch('notify', title: 'success', message: 'Data profil berhasil di update');
        }
    }

    public function store_permissions($id)
    {
        $role = ExtendedRole::findOrFail($id);
        // Get the selected permissions from the request
        $permissions = request()->input('permissions', []);

        // Filter out invalid or non-existent permission IDs
        $validPermissions = ExtendedPermission::whereIn('id', $permissions)->pluck('id')->toArray();

        // Assign valid permissions to the role
        $this->attachPermissions($role, $validPermissions);

        // Redirect back or perform other actions as needed

        // Dispatch the notification
        $this->dispatch('notify', title: 'success', message: 'Success update access role permission');
        session()->flash('message', 'Success update access role permission');
        // Redirect back or perform other actions as needed
        return redirect()->to('/roles');



    }

    /**
     * Assign the permissions to the role.
     *
     * @param ExtendedRole $role
     * @param array $permissions
     */
    protected function attachPermissions(ExtendedRole $role, array $permissions)
    {
        $role->syncPermissions($permissions);
    }


}

