<?php

namespace App\Http\Livewire\TaskType;

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
            'livewire.task-type.table',
            [
                'task_types' => TaskType::where('name', 'like', "%{$this->search__name}%")->orderBy('name', 'asc')->paginate(10)
            ]
        );

    }

    public function openDeleteModal($id){
        $id=base64_decode($id);
        $this->emit('openDeleteModal', $id);
    }
}
