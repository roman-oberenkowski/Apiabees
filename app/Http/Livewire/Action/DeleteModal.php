<?php

namespace App\Http\Livewire\Action;

use App\Models\Action;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;
    public ?int $action_id;
    protected $listeners = [
        'openActionDeleteModal' => 'openModal',
    ];

    public function openModal($id)
    {
        try {
            Action::findOrFail($id);
            $this->action_id=$id;
            $this->isModalOpen = true;
        } catch (ModelNotFoundException $e) {
            flash("Couldn't find that action. Already deleted?")->info()->livewire($this);
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedActionDeleteModal');
    }

    public function destroy()
    {
        try {
            $tmp=Action::findOrFail($this->action_id);
            $tmp->delete();
            flash("Action has been deleted.")->success()->livewire($this);
        }
        catch (ModelNotFoundException $e) {
            flash("Couldn't find that action. Already deleted?")->info()->livewire($this);
        }
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.action.delete-modal');
    }
}
