<?php

namespace App\Http\Livewire\BeeFamily;

use App\Models\BeeFamily;
use App\Models\Hive;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class AssignHiveModal extends Component
{
    public bool $isModalOpen = false;

    public string $bee_family_id = '';
    public string $old_hive_id='';
    public string $new_hive_id='';



    protected $listeners = [
        'openBeeFamilyAssignHiveModal' => 'openModal',
        'HiveChooseModalChoosen'=>'hiveChoosen'
    ];

    public function resetSelectedTargetHive(){
        $this->new_hive_id='';
    }

    public function unassign_hive($bee_family){
        if($bee_family->hive != null){
            $bee_family->hive->bee_family_id=null;
            $bee_family->hive->save();
            $bee_family->hive_id=null;
            $bee_family->save();
        }
    }
    public function assign_hive($bee_family,$new_hive){
        //bee family and new hive should be 'clean' (unassigned to any other)
        if($bee_family->hive_id!=null || $new_hive->bee_family_id!=null){dd($this);}
        $bee_family->hive_id=$new_hive->id;
        $new_hive->bee_family_id=$bee_family->id;
        $bee_family->save();
        $new_hive->save();
    }

    public function assign()
    {
        try {
            $bee_family=BeeFamily::findOrFail($this->bee_family_id);
        }catch (ModelNotFoundException $e) {
            flash("Cannot find chosen bee-family. Please check if bee-family is still in the database and try again")->error()->livewire($this);
            $this->closeModal();
            return;
        }
        if($this->new_hive_id!=null){
            try {
                $new_hive=Hive::findOrFail($this->new_hive_id);
            }catch (ModelNotFoundException $e) {
                $this->addError('choosen_hive',"Cannot find chosen hive. Please check if that hive is still in the database and try again");
                return;
            }
        }
        else{
            $this->unassign_hive($this->bee_family_id);
            flash("Bee family successfully removed from hive (moved to storage).")->success()->livewire($this);
            $this->closeModal();
        }
        if($bee_family->die_off_date!=null){
            $this->addError('choosen_hive',"That bee family is dead!");
            return;
        }
        if($new_hive->bee_family_id!=null){
            $this->addError('choosen_hive',"That hive is not empty!");
            return;
        }

        $this->unassign_hive($bee_family);
        $this->assign_hive($bee_family,$new_hive);

        flash("Bee family successfully assigned to new hive.")->success()->livewire($this);
        $this->closeModal();


    }

    public function openModal($bee_family_id)
    {
        try{
            $this->reset();
            $this->resetValidation();
            $this->loadData($bee_family_id);
            $this->isModalOpen = true;
        }catch (ModelNotFoundException $e) {
            flash("Cannot find selected bee family. Please check if selected bee family is still in the database and try again")->error()->livewire($this);
            $this->closeModal();
        }
    }


    public function loadData($bee_family_id)
    {
        $bee_family=BeeFamily::findOrFail($bee_family_id);
        $this->bee_family_id=$bee_family_id;
        if($bee_family->hive!=null){
            $this->old_hive_id=$bee_family->hive->id;
        }
    }

    public function closeModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = false;
        $this->emit('closedBeeFamilyAssignHiveModal');
    }

    public function render()
    {
        return view('livewire.bee-family.assign-hive-modal');
    }

    public function openOldHiveDetailsModal(){
        $this->emit('openHiveDetailsModal',$this->old_hive_id);
    }

    public function openNewHiveDetailsModal(){
        $this->emit('openHiveDetailsModal',$this->new_hive_id);
    }

    public function chooseHive(){
        $this->emit('openHiveChooseModal');
    }

    public function hiveChoosen($chosen_hive){
        $hive=Hive::find($chosen_hive);
        if(isset($hive)){
            $this->new_hive_id=$chosen_hive;
            //$this->validateOnly('hive_id');
            if($hive->bee_family_id!=null){
                $this->addError('choosen_hive',"That hive is not empty!");
            }
        }
        else{
            $this->addError('choosen_hive',"Cannot find chosen hive. Please check if that hive is still in the database and try again");
        }
    }
    public function loadOpt($opt){
        if($opt==null)return "None";
        return $opt;
    }
}
