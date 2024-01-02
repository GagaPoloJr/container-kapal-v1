<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class SelectDropdownSearch extends Component
{
    public $i = 1;
    public $suppliers, $options = [];

    public $inputSearch = '';
    public $value_id;
    public $placeholder;

    public function selectOption($value_id)
    {
        $this->value_id = $value_id;
        $this->inputSearch = '';
    }

    public function mount($options= [], $placeholder=null)
    {
        $this->options = $options;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        $searchResults = [];

        // if (strlen($this->inputSearch) > 0) {
        //     $searchResults = Customer::where('nama', 'LIKE', '%' . $this->inputSearch . '%')
        //         ->orWhere('kode', 'LIKE', '%' . $this->inputSearch . '%') 
        //         ->get();
        // }

        if(strlen($this->inputSearch) > 0){
            $searchResults = array_filter($this->options, function($option, $attributes){
                return stripos($option[$attributes], $this->inputSearch) !== false;
            });
        dd($searchResults);

        }

        return view('livewire.select-dropdown-search')->with(['searchsuppliers' => $searchResults]);

    }
}
