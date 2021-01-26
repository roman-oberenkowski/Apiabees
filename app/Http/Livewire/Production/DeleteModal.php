<?php

namespace App\Http\Livewire\Production;

use App\Models\HoneyProduction;
use App\Models\WaxProduction;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;

    public string $production_id='';
    public bool $isHoney=true;

    protected $listeners = [
        'openWaxProductionDeleteModal' => 'openWaxModal',
        'openHoneyProductionDeleteModal' => 'openHoneyModal',
    ];

    public function openWaxModal($id_prod)
    {
        $this->isHoney=false;
        $this->openModal($id_prod);
    }
    public function openHoneyModal($id_prod){
        $this->isHoney=true;
        $this->openModal($id_prod);
    }
    public function openModal($id_prod){

        $this->production_id=$id_prod;
        if($this->isHoney)
            $tbd = HoneyProduction::find($this->production_id);
        else
            $tbd= WaxProduction::find($this->production_id);
        if (!isset($tbd)){
            flash("Cannot delete production - probably already deleted.")->info()->livewire($this);
            $this->closeModal();
            return;
        }
        $this->isModalOpen=true;

    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedProductionDeleteModal');
        $this->reset();
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
