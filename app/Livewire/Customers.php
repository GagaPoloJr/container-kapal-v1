<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;


    public $nama, $kode, $email, $no_hp, $alamat, $asal, $npwp, $customer_id;
    public $isModalOpen = false;
    public $isModalDelete = false;
    public $isUpdatePage = false;
    public $page = 1;
    public $perPage = 10;
    public $search = '';
    public $sortDirection = 'DESC';
    public $sortColumn = 'created_at';
    public $confirmDeleteId;


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
    #[On('dispatch-customers-table')]
    public function mount()
    {
        if (session()->has('page')) {
            $this->page = session('page');
        }
    }

    /**
     * Render the data on the customer table.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $columns = [
            ['label' => 'Kode', 'column' => 'kode', 'isData' => true],
            ['label' => 'Nama Pelanggan', 'column' => 'nama', 'isData' => true],
            ['label' => 'Email', 'column' => 'email', 'isData' => true],
            ['label' => 'Nomor HP', 'column' => 'no_hp', 'isData' => true],
            ['label' => 'Alamat', 'column' => 'alamat', 'isData' => true],
            ['label' => 'Asal', 'column' => 'asal', 'isData' => true],
            ['label' => 'NPWP', 'column' => 'npwp', 'isData' => true],
            ['label' => 'Action', 'column' => 'action', 'isData' => false],
        ];

        $customers = Customer::search($this->search)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage, ['*'], 'page');

        return view('livewire.customers.index', compact('customers', 'columns'));
    }

    public function customFormat($column, $data)
    {
        switch ($column) {
            case 'created_at':
                $parsedDate = \Carbon\Carbon::parse($data);
                return $parsedDate->diffForHumans();
            default:
                return $data;
        }
    }


    /**
     * Confirm the creation of a new customer.
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
     * Reset the form for creating a new customer.
     *
     * @return void
     */
    private function resetCreateForm()
    {
        $this->nama = '';
        $this->kode = '';
        $this->email = '';
        $this->no_hp = '';
        $this->alamat = '';
        $this->asal = '';
        $this->npwp = '';
    }

    /**
     * Store or update a customer record.
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => 'required|max:10',
            'email' => 'required|email',
            'no_hp' => 'required|max:16',
            'alamat' => 'required',
            'asal' => 'required',
            'npwp' => 'required',
        ]);

        try {

            Customer::updateOrCreate(['id' => $this->customer_id], [
                'nama' => $this->nama,
                'kode' => $this->kode,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
                'asal' => $this->asal,
                'npwp' => $this->npwp,
            ]);

            if ($this->isUpdatePage) {
                $this->dispatch('notify', title: 'success', message: 'Data Customer ' .$this->nama.' berhasil diubah');

            } else {
                $this->dispatch('notify', title: 'success', message: 'Data Customer berhasil ditambahkan');

            }
            $this->closeModalPopover();
            $this->resetCreateForm();
            $this->dispatch('dispatch-customers-table');
        } catch (ValidationException $e) {
            // Validation failed
            $this->dispatch('notify', title: 'error', message: $e->validator->errors());
        } catch (\Exception $e) {
            // Other exceptions
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
        $customer = Customer::findOrFail($id);
        $this->customer_id = $id;
        $this->nama = $customer->nama;
        $this->kode = $customer->kode;
        $this->email = $customer->email;
        $this->no_hp = $customer->no_hp;
        $this->alamat = $customer->alamat;
        $this->asal = $customer->asal;
        $this->npwp = $customer->npwp;
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
            $customer = Customer::findOrFail($this->confirmDeleteId);
            $customer->delete();
            $this->dispatch('notify', title: 'success', message: 'Data Customer ' . $customer->name . ' berhasil dihapus');
            $this->closeModalPopover();
            $this->search = ''; // Reset search after successful delete
            $this->dispatch('dispatch-customers-table');
        } catch (\Exception $e) {
            $this->dispatch('notify', title: 'error', message: 'An error occurred while deleting the data.');
        }
    }

}
