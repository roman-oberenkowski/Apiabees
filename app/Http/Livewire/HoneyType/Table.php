<?php

namespace App\Http\Livewire\HoneyType;

use Livewire\Component;
use App\Models\HoneyType;
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
            'livewire.honey-type.table',
            [
                'honey_types' => HoneyType::where('name', 'like', "%{$this->search__name}%")->orderBy('name', 'asc')->paginate(5)
            ]
        );

    }

    public function openDeleteModal($id){
        $this->emit('openDeleteModal', $id);
    }
}
