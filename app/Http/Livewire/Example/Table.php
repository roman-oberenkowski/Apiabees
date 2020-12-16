<?php

namespace App\Http\Livewire\Example;

use Livewire\Component;

class Table extends Component
{
    public $isDeleteModalOpen = false;

    public $isEditModalOpen = false;

    public function render()
    {
        return view('livewire.example.table');
    }
}
