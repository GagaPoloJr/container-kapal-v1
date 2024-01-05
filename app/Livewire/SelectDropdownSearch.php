<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class SelectDropdownSearch extends Component
{
    public $i = 1;
    public $inputValue = '';
    public $inputSearch = '';
    public $value_id, $value;

    public $modelValue;
    public $placeholder;
    public $options = [];

    public $isSectionVisible, $isDropdownVisible = false;
    public $selectedOption = null;
    public $search = '';
    public $searchAttribute = 'nama';

    public $selectedItem;

    public function toggleDropdown()
    {
        $this->isDropdownVisible = !$this->isDropdownVisible;
    }

    public function selectOption($value_id, $nama)
    {

        $this->value_id = $value_id;
        $this->resetCreateForm();
        $this->toggleDropdown();
        $this->value = $value_id;

        $this->dispatch('selectOption', ['field' => $this->modelValue, 'value' => $this->value]);

    }

    public function mount($options = [], $placeholder = null, $modelValue, $value_id)
    {
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->modelValue = $modelValue;
        $this->value_id = $value_id;
    }



    private function resetCreateForm()
    {
        $this->inputSearch = '';
    }

    public function render()
    {
        $searchResults = [];

        if (strlen($this->inputSearch) > 0) {
            $searchResults = array_filter($this->options->toArray(), function ($option) {
                foreach ($option as $attribute) {
                    if (stripos($option[$this->searchAttribute], $this->inputSearch) !== false) {
                        return true;
                    }
                }

                return false;
            });

        } else {
            $searchResults = $this->options->toArray();
        }

        return view('livewire.select-dropdown-search')->with(['searchOptions' => $searchResults]);
    }

}
