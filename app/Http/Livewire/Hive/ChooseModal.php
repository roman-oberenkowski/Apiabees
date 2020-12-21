<?php

namespace App\Http\Livewire\Hive;

use App\Models\Hive;
use Livewire\Component;

class ChooseModal extends Component
{
    public bool $isModalOpen = false;

    protected $listeners = [
        'openHiveChooseModal' => 'openModal',
    ];

    public function openModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = true;
    }

    public function closeModal(){
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = false;
    }

    public function choose(){
        $this->emit('HiveChooseModalChoosen',1);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.hive.choose-modal');
    }
}
