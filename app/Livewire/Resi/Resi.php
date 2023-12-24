<?php

namespace App\Livewire\Resi;

use App\Models\ResiModel;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Resi extends Component
{

    use WithPagination;

    public $no_resi, $plat_nomor, $warna, $kapasitas, $truck_id;
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
    #[On('dispatch-resi-table')]
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
            ['label' => 'No Resi', 'column' => 'no_resi', 'isData' => true],
            ['label' => 'Kota Keberangkatan', 'column' => 'kota_keberangkatan', 'isData' => true],
            // ['label' => 'Warna', 'column' => 'warna', 'isData' => true],
            // ['label' => 'Kapasitas', 'column' => 'kapasitas', 'isData' => true],
            ['label' => 'Created', 'column' => 'created_at', 'isData' => true],
            ['label' => 'Action', 'column' => 'action', 'isData' => false],
        ];

        $resi = ResiModel::search($this->search)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage, ['*'], 'page');

        return view('livewire.resi.index', compact('resi', 'columns'));
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
            $resi = ResiModel::findOrFail($this->confirmDeleteId);
            $resi->delete();
            $this->dispatch('notify', title: 'success', message: 'Data Resi ' . $resi->no_resi . ' berhasil dihapus');
            $this->closeModalPopover();
            $this->search = ''; // Reset search after successful delete
            $this->dispatch('dispatch-resi-table');
        } catch (\Exception $e) {
            $this->dispatch('notify', title: 'error', message: $e. 'An error occurred while deleting the data.');
        }
    }


  


}
