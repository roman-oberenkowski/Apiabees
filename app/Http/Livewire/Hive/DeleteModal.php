<?php

namespace App\Http\Livewire\Hive;

use App\Models\BeeFamily;
use App\Models\Hive;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;
    public string $hive_id='';
    protected $listeners = [
        'openHiveDeleteModal' => 'openModal',
    ];

    public function openModal($id)
    {
        try {
            $h=Hive::findOrFail($id);
            if($h->bee_family_id!=null){
                flash("That hive has bee family inside - cannot delete! Please move that family to other hive and try again")->info()->livewire($this);
                return;
            }
            $this->hive_id=$id;
            $this->isModalOpen = true;
        } catch (ModelNotFoundException $e) {
            flash("Couldn't find that Hive. Already deleted?")->info()->livewire($this);
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedHiveDeleteModal');
    }

    public function destroy()
    {
        try {
            $tbd=Hive::findOrFail($this->hive_id);
            if($tbd->bee_family_id!=null){
                flash("That hive has bee family inside - cannot delete!")->info()->livewire($this);
                $this->closeModal();
                return;
            }
            $tbd->delete();
            flash("Hive has been deleted.")->success()->livewire($this);
        }
        catch (ModelNotFoundException $e) {
            flash("Couldn't find that Hive. Already deleted?")->info()->livewire($this);
        }
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.hive.delete-modal');
    }
}
