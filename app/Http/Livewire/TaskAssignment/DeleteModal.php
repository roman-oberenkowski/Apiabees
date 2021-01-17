<?php

namespace App\Http\Livewire\TaskAssignment;

use App\Models\Action;
use App\Models\TaskAssignment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;
    public string $ta_id='';
    protected $listeners = [
        'openTaskAssignmentDeleteModal' => 'openModal',
    ];

    public function openModal($input_id)
    {
        try {
            TaskAssignment::findOrFail($input_id);
            $this->ta_id=$input_id;
            $this->isModalOpen = true;
        } catch (ModelNotFoundException $e) {
            flash("Couldn't find that task assignment. Already deleted?")->info()->livewire($this);
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedTaskAssignmentDeleteModal');
    }

    public function destroy()
    {
        try {
            $tmp=TaskAssignment::findOrFail($this->ta_id);
            $tmp->delete();
            flash("Task assignment has been deleted.")->success()->livewire($this);
        }
        catch (ModelNotFoundException $e) {
            flash("Couldn't find that TaskAssignment. Already deleted?")->info()->livewire($this);
        }
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.task-assignment.delete-modal');
    }
}
