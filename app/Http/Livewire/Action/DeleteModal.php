<?php

namespace App\Http\Livewire\Action;

use App\Models\Action;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;
    public Action $action_tbd;
    public string $name='';

    protected $listeners = [
        'openActionDeleteModal' => 'openModal',
    ];


    public function openModal($id)
    {
        try {
            $this->action_tbd=Action::findOrFail($id);
            $this->isModalOpen = true;
        } catch (\Exception $e) {
            flash("Couldn't find that action. Already deleted?")->error()->livewire($this);
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedActionDeleteModal');
    }


    public function destroy()
    {


        $this->action_tbd->delete();
        flash("Action has been deleted.")->success()->livewire($this);

        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.action.delete-modal');
    }
}
