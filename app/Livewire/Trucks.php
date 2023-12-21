<?php

namespace App\Livewire;

use App\Models\Truck;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class Trucks extends Component
{
    use WithPagination;

    public $merk, $plat_nomor, $warna, $kapasitas, $truck_id;
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
    #[On('dispatch-trucks-table')]
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
            ['label' => 'Merk', 'column' => 'merk', 'isData' => true],
            ['label' => 'Plat Nomor', 'column' => 'plat_nomor', 'isData' => true],
            ['label' => 'Warna', 'column' => 'warna', 'isData' => true],
            ['label' => 'Kapasitas', 'column' => 'kapasitas', 'isData' => true],
            ['label' => 'Created', 'column' => 'created_at', 'isData' => true],
            ['label' => 'Action', 'column' => 'action', 'isData' => false],
        ];

        $trucks = Truck::search($this->search)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage, ['*'], 'page');

        return view('livewire.trucks.index', compact('trucks', 'columns'));
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
        $this->resetErrorBag();
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
            'merk' => 'required',
            'plat_nomor' => 'required|max:10',
            'warna' => 'required|max:10',
            'kapasitas' => 'required|max:10',
        ]);

        try {
            $data = [
                'merk' => $this->merk,
                'plat_nomor' => $this->plat_nomor,
                'warna' => $this->warna,
                'kapasitas' => $this->kapasitas,
            ];
            if ($this->isUpdatePage) {
                // Use update method with the correct syntax
                Truck::where('id', $this->truck_id)->update($data);

                $this->dispatch('notify', title: 'success', message: 'Data Truk berhasil diubah');
            } else {
                // Use create method for inserting new records
                Truck::create($data);

                $this->dispatch('notify', title: 'success', message: 'Data Truk berhasil ditambahkan');
            }
            $this->closeModalPopover();
            $this->resetCreateForm();
            $this->dispatch('dispatch-trucks-table');
        } catch (ValidationException $e) {
            $this->dispatch('notify', title: 'error', message: $e->validator->errors());
        } catch (\Exception $e) {
            $this->dispatch('notify', title: 'error', message: $e . 'An error occurred while saving the data.');
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
        $truck = Truck::findOrFail($id);
        $this->truck_id = $id;
        $this->merk = $truck->merk;
        $this->plat_nomor = $truck->plat_nomor;
        $this->kapasitas = $truck->kapasitas;
        $this->warna = $truck->warna;
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
            $truck = Truck::findOrFail($this->confirmDeleteId);
            $truck->delete();
            $this->dispatch('notify', title: 'success', message: 'Data Truk plat ' . $truck->plat_nomor . ' berhasil dihapus');
            $this->closeModalPopover();
            $this->search = ''; // Reset search after successful delete
            $this->dispatch('dispatch-trucks-table');
        } catch (\Exception $e) {
            $this->dispatch('notify', title: 'error', message: 'An error occurred while deleting the data.');
        }
    }
}
