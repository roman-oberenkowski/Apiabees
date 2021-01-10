<?php

namespace App\Http\Livewire\Apiary;

use App\Models\ActionType;
use App\Models\Employee;
use Livewire\Component;
use App\Models\Apiary;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\Boolean;

class Table extends Component
{
    use WithPagination;
    public bool $isModalOpen=true;
    public string $search_name = '';
    public string $search_code_name = '';

    protected $listeners = [
        'closedApiaryDeleteModal' => '$refresh',
        'closedApiaryEditModal' => '$refresh'
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view(
            'livewire.apiary.table',
                [
                    'apiaries' =>
                        Apiary::where('code_name', 'like', "%{$this->search_code_name}%")
                            ->where('name', 'like', "%{$this->search_name}%")
                            ->paginate(5),
                ]
        );
    }

    public function openApiaryDeleteModal($id){
        $this->emit('openApiaryDeleteModal', $id);
    }
    public function openApiaryDetailsModal($id){
        $this->emit('openApiaryDetailsModal', $id);
    }
    public function openApiaryEditModal($id){
        $this->emit('openApiaryEditModal', $id);
    }
}
