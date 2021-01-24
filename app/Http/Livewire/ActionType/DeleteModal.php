<?php

namespace App\Http\Livewire\ActionType;

use App\Models\ActionType;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;

    public string $name='';

    protected $listeners = [
        'openDeleteModal' => 'openModal',
    ];

    protected $rules = [
        'name' => ['required', 'string','exists:action_types'],
    ];

    public function openModal(string $name)
    {
        $ac=ActionType::find($name);
        if($ac==null){
            flash("Cannot selected action type - probably already deleted.")->info()->livewire($this);
            return;
        }
        $this->resetValidation();
        $this->name = $name;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->resetValidation();
        $this->isModalOpen = false;
        $this->emit('closedDeleteModalForm');
    }

    public function destroy()
    {
        $action_type_to_delete = ActionType::find($this->name);
        if (!isset($action_type_to_delete)){
            flash("Cannot delete action type {$this->name} - probably already deleted.")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        if(ActionType::isSpecial($this->name)) {
            flash("Cannot delete special action type {$this->name}.")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        if( ($cnt=$action_type_to_delete->actions->count())>0){
            flash("Cannot delete action type {$this->name} - this action type is used by {$cnt} action(s).")->error()->livewire($this);
            $this->closeModal();
            return;
        }

        $action_type_to_delete->delete();
        flash("Action type {$action_type_to_delete->name} has been deleted.")->success()->livewire($this);
        $this->closeModal();
        return redirect()->to('/action-types')->back();
    }


    public function render()
    {
        return view('livewire.action-type.delete-modal');
    }
}
