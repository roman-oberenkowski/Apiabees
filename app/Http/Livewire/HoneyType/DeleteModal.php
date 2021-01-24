<?php

namespace App\Http\Livewire\HoneyType;

use App\Models\HoneyType;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;

    public string $name='';

    protected $listeners = [
        'openDeleteModal' => 'openModal',
    ];

    protected $rules = [
        'name' => ['required', 'string','exists:honey_types'],
    ];

    public function openModal(string $name)
    {
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
        $honey_type_to_delete = HoneyType::find($this->name);
        if (!isset($honey_type_to_delete)){
            flash("Cannot delete honey type {$this->name} - probably already deleted.")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        if( ($cnt=$honey_type_to_delete->honeyProductions->count())>0){
            flash("Cannot delete honey type {$this->name} - this honey type is used by {$cnt} honey production(s).")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        $honey_type_to_delete->delete();
        flash("Honey type {$honey_type_to_delete->name} has been deleted.")->success()->livewire($this);
        return redirect()->to('/honey-types')->back();
        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.honey-type.delete-modal');
    }
}
