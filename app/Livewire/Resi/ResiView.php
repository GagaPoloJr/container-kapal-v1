<?php

namespace App\Livewire\Resi;

use App\Models\Customer;
use App\Models\ResiModel;
use App\Models\Setting;
use Livewire\Component;

class ResiView extends Component
{

    public $resi,$containers,$items,$settings, $customers;

    public function mount($id){
        $this->resi = ResiModel::findOrFail($id);
        $this->containers = $this->resi->containers;
        $this->settings = Setting::findOrFail(1);
        $this->customers =  Customer::findOrFail($this->resi->customer_id) ;
        // dd($this->customers);
        // dd($this->containers);
        // $this->items = $this->containers->items;
        // foreach ($this->containers as $container) {
        //     $items = $container->items;
        //     dd($items);  // This will display items related to each container
        // }
    }
    public function render()
    {
        return view('livewire.resi.resi-view');
    }
}
