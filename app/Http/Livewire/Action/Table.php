<?php

namespace App\Http\Livewire\Action;

use Livewire\Component;
use App\Models\Action;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public string $search__name = '';

    protected $listeners = [
        'closedActionDeleteModalForm' => '$refresh',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view(
            'livewire.action.table',
                [
                'actions' => Action::orderBy('performed_at', 'desc')->paginate(5)
                ]
        );

    }

    public function formatDescription($in){
        if(strlen($in)>32)
            return substr($in,0,29).'...';
        return $in;
    }

    public function openDeleteModal($id){
        $this->emit('openActionDeleteModal', $id);
    }
}
