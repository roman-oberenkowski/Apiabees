<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExampleTable extends Component
{
    public $isDeleteModalOpen = false;

    public $isEditModalOpen = false;

    public function render()
    {
        return view('livewire.example-table');
    }
}
