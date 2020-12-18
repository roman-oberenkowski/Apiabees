<?php

namespace App\Http\Livewire\ActionType;

use App\Models\ActionType;
use App\Models\Employee;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;

    public string $name='';

    protected $listeners = [
        'openActionTypeDeleteModal' => 'openModal',
    ];

    protected $rules = [
        'name' => ['required', 'string','exists:action_types'],
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function openModal(string $name)
    {
        $this->resetValidation();
        $this->name = $name;
        $this->isModalOpen = true;
    }

    /**
     * Closes modal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->resetValidation();
        $this->isModalOpen = false;
        $this->emit('closedDeleteModalForm');
    }


    public function destroy()
    {

        $action_type_to_delete = ActionType::find($this->name);
        if (!isset($action_type_to_delete))
        {
            flash("Cannot delete action type {$this->name} - probably already deleted.")->error()->livewire($this);
            $this->emit('closedDeleteModalForm');
        }
        else
        {
            $action_type_to_delete->delete();
            flash("Action type {$action_type_to_delete->name} has been deleted.")->success()->livewire($this);
            $this->emit('closedDeleteModalForm');
        }
        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.action-type.delete-modal');
    }
}
