<?php

namespace App\Http\Livewire\Hive;

use App\Models\ActionType;
use App\Models\Employee;
use Livewire\Component;
use App\Models\Hive;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\Boolean;

class Table extends Component
{
    use WithPagination;
    public bool $isModal;
    public bool $isModalOpen=true;
    public string $search__name = '';
    public string $message='';

    protected $listeners = [
        'closedHiveDeleteModal' => '$refresh',
    ];

    public function mount()
    {
        $this->resetPage();
        if($this->isModal)$this->message='got modal';
        else $this->message='got normal';
    }

    public function render()
    {

        return view(
            'livewire.hive.table',
                [
                    'hives' => Hive::paginate(5),

                ]
        );

    }

    public function openDeleteModal($id){
        $this->emit('openHiveDeleteModal', $id);
    }
}
