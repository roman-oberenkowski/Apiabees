<?php

namespace App\Http\Livewire\TaskType;

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
        'name' => ['required', 'string','exists:task_types'],
    ];

    public function openModal(string $name)
    {
        $this->reset();
        $this->resetValidation();
        $this->name = $name;
        $task_type_to_delete = TaskType::find($this->name);
        if (!isset($task_type_to_delete)){
            flash("Cannot delete task type {$this->name} - probably already deleted.")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        if( ($cnt=$task_type_to_delete->employeesTasks->count())>0){
            flash("Cannot delete task type {$this->name} - this task type is used by {$cnt} task(s).")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedDeleteModalForm');
    }

    public function destroy()
    {
        $task_type_to_delete = TaskType::find($this->name);
        if (!isset($task_type_to_delete)){
            flash("Cannot delete task type {$this->name} - probably already deleted.")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        if( ($cnt=$task_type_to_delete->employeesTasks->count())>0){
            flash("Cannot delete task type {$this->name} - this task type is used by {$cnt} task(s).")->error()->livewire($this);
            $this->closeModal();
            return;
        }

        $task_type_to_delete->delete();
        flash("Task type {$task_type_to_delete->name} has been deleted.")->success()->livewire($this);
        //return redirect()->to('/honey-types')->back();
        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.task-type.delete-modal');
    }
}
