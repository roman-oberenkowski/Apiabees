<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public string $search__first_name = '';

    public string $search__last_name = '';

    protected $listeners = [
        'closedDeleteModalForm' => '$refresh',
        'closedEditModalForm' => '$refresh'
    ];

    /**
     * The livewire mount function
     *
     * @return void
     */
    public function mount()
    {
        $this->resetPage();
    }

    public function resetSearch(){
        $this->search__first_name='';
        $this->search__last_name='';
    }

    /**
     * The read function
     *
     * @return void
     */
    public function read()
    {
        return Employee::where('first_name', 'like', "%{$this->search__first_name}%")
            ->where('last_name', 'like', "%{$this->search__last_name}%")
            ->paginate(10);
    }

    /**
     * Opens selected modal
     *
     * @param string $modal_type
     * @param $id
     *
     * @return void
     */
    public function openModal(string $modal_type, $id) {
        $this->resetValidation();
        switch ($modal_type)
        {
            case 'edit':
                $this->emit('openEmployeeEditModalForm', $id);
                break;
            case 'details':
                $this->emit('openEmployeeDetailsModal', $id);
                break;
            case 'delete':
                $this->emit('openEmployeeDeleteModalForm', $id);
                break;

        }
    }

    public function render()
    {
        return view('livewire.employee.table', [
            'employees' => $this->read()
        ]);
    }
}
