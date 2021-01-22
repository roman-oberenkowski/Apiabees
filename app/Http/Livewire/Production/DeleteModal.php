<?php

namespace App\Http\Livewire\Production;

use App\Models\HoneyProduction;
use App\Models\WaxProduction;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;

    public ?int $production_id=null;
    public ?bool $isHoney=null;

    protected $listeners = [
        'openWaxProductionDeleteModal' => 'openWaxModal',
        'openHoneyProductionDeleteModal' => 'openHoneyModal',
    ];

    public function openWaxModal($id)
    {
        $this->isHoney=false;
        $this->openModal($id);
    }
    public function openHoneyModal($id){
        $this->isHoney=true;
        $this->openModal($id);
    }
    public function openModal($id){
        $this->production_id=$id;
        $this->isModalOpen=true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedProductionDeleteModal');
    }

    public function destroy()
    {
        if($this->isHoney)
            $tbd = HoneyProduction::find($this->production_id);
        else
            $tbd= WaxProduction::find($this->production_id);
        if (!isset($tbd)){
            flash("Cannot delete production - probably already deleted.")->info()->livewire($this);
            $this->closeModal();
            return;
        }
        $tbd->delete();
        flash("Production has been deleted.")->success()->livewire($this);
        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.production.delete-modal');
    }
}
