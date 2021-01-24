<?php

namespace App\Http\Livewire\StateType;

use App\Models\ActionType;
use App\Models\StateType;
use App\Models\TaskType;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;

    public string $name='';

    protected $listeners = [
        'openDeleteModal' => 'openModal',
    ];

    protected $rules = [
        'name' => ['required', 'string','exists:state_types'],
    ];

    public function openModal(string $name)
    {
        //$this->resetValidation();
        $this->name = $name;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        //$this->resetValidation();
        $this->isModalOpen = false;
        $this->emit('closedDeleteModalForm');
    }

    public function destroy()
    {
        $state_type_to_delete = StateType::find($this->name);
        if (!isset($state_type_to_delete)){
            flash("Cannot delete state type {$this->name} - probably already deleted.")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        if(StateType::isSpecial($this->name)) {
            flash("Cannot delete special state type {$this->name}.")->error()->livewire($this);
            $this->closeModal();
            return;
        }

        if( ($cnt=$state_type_to_delete->familyStates->count())>0){
            flash("Cannot delete state type {$this->name} - this task type is used by {$cnt} familiy(s).")->error()->livewire($this);
            $this->closeModal();
            return;
        }

        $state_type_to_delete->delete();

        flash("State type {$state_type_to_delete->name} has been deleted.")->success()->livewire($this);

        //return redirect()->to('/state-types');
        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.state-type.delete-modal');
    }
}
