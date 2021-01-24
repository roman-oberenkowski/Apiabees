<?php

namespace App\Http\Livewire\StateType;

use App\Models\StateType;
use Livewire\Component;
use App\Models\TaskType;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public string $search__name = '';

    protected $listeners = [
        'closedDeleteModalForm' => '$refresh',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        if($propertyName=='search__name')
            $this->resetPage();
    }

    public function render()
    {
        return view(
            'livewire.state-type.table',
            [
                'state_types' => StateType::where('name', 'like', "%{$this->search__name}%")->orderBy('name', 'asc')->paginate(5)
            ]
        );

    }

    public function openDeleteModal($id){
        $id=base64_decode($id);
        $this->emit('openDeleteModal', $id);
    }
}
