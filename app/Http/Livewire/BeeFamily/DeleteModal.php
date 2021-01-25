<?php

namespace App\Http\Livewire\BeeFamily;

use App\Models\BeeFamily;
use App\Models\Hive;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;
    public string $beefamily_id='';
    protected $listeners = [
        'openBeeFamilyDeleteModal' => 'openModal',
    ];

    public function openModal($id)
    {
        $this->reset();
        try {
            BeeFamily::withTrashed()->findOrFail($id);
            $this->beefamily_id=$id;
            $this->isModalOpen = true;
        } catch (ModelNotFoundException $e) {
            flash("Couldn't find that Bee Family. Already deleted?")->info()->livewire($this);
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedBeeFamilyDeleteModal');
    }

    public function destroy()
    {
        try {
            $tbd=BeeFamily::withTrashed()->findOrFail($this->beefamily_id);
            if($tbd->hive!=null){
                $tbd->hive->bee_family_id=null;
                $tbd->hive->save();
            }
            $tbd->forceDelete();
            flash("BeeFamily has been deleted.")->success()->livewire($this);
        }
        catch (ModelNotFoundException $e) {
            flash("Couldn't find that BeeFamily. Already deleted?")->info()->livewire($this);
        }
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.bee-family.delete-modal');
    }
}
