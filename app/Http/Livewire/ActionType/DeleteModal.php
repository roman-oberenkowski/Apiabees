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
        'name' => ['required', 'string'],
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
        $this->emit('closedActionTypeDeleteModalForm');
    }


    public function destroy()
    {

        $action_type_to_delete = ActionType::find($this->name);
        if (!isset($action_type_to_delete))
        {
            session()->flash('message', "Cannot delete action type with given name.");
            $this->emit('closedActionTypeDeleteModalForm_Cancelled');
        }
        else
        {
            $action_type_to_delete->delete();
            session()->flash('message', "Action type {$action_type_to_delete->name} has been deleted.");
            $this->emit('closedActionTypeDeleteModalForm_Success');
        }
        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.action-type.delete-modal');
    }
}
