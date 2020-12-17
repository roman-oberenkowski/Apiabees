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
        'closedActionTypeDeleteModalForm_Success' => 'reload',
        'closedActionTypeCreateModalForm_Success' => 'reload',
    ];

    public function mount()
    {
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
        $this->emit('openActionTypeDeleteModal', $id);
    }

    public function reload2(){
        $temp_filter=$this->search__name;
        $this->reset();
        $this->search__name=$temp_filter;
        session()->flash('message', 'Reloaded with search save');
    }
    public function reload(){
        $this->render();
    }

}
