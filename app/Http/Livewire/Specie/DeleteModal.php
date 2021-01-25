<?php

namespace App\Http\Livewire\Specie;

use App\Models\Specie;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;

    public string $name='';

    protected $listeners = [
        'openDeleteModal' => 'openModal',
    ];

    protected $rules = [
        'name' => ['required', 'string','exists:species'],
    ];

    public function openModal(string $name)
    {
        $this->reset();
        $this->resetValidation();
        $this->name = $name;
        $specie_to_delete = Specie::find($this->name);
        if (!isset($specie_to_delete)){
            flash("Cannot delete specie {$this->name} - probably already deleted.")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        if( ($cnt=$specie_to_delete->beeFamilies->count())>0){
            flash("Cannot delete specie {$this->name} - this specie is used by {$cnt} bee families.")->error()->livewire($this);
            $this->closeModal();
            return;
        }
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
        $specie_to_delete = Specie::find($this->name);
        if (!isset($specie_to_delete)){
            flash("Cannot delete specie {$this->name} - probably already deleted.")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        if( ($cnt=$specie_to_delete->beeFamilies->count())>0){
            flash("Cannot delete specie {$this->name} - this specie is used by {$cnt} bee families.")->error()->livewire($this);
            $this->closeModal();
            return;
        }

        $specie_to_delete->delete();
        flash("Specie {$specie_to_delete->name} has been deleted.")->success()->livewire($this);
        //return redirect()->to('/honey-types')->back();
        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.specie.delete-modal');
    }
}
