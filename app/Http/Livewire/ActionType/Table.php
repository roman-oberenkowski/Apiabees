<?php

namespace App\Http\Livewire\ActionType;

use Livewire\Component;
use App\Models\ActionType;
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
            'livewire.action-type.table',
            [
                'action_types' => ActionType::where('name', 'like', "%{$this->search__name}%")->orderBy('name', 'asc')->paginate(5)
            ]
        );

    }

    public function openDeleteModal($id){
        $this->emit('openDeleteModal', $id);
    }
}
