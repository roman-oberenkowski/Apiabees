<?php

namespace App\Http\Livewire\BeeFamily;

use App\Models\BeeFamily;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DetailsModal extends Component
{
    public bool $isModalOpen = false;
    public string $bee_family_id = '';
    public string $acquired_at = '';
    public string $population = '';
    public string $die_off_date = '';
    public string $species_name = '';
    public string $hive_id = '';
    public string $choosen_hive_info = '';
    public string $hive_apiary_code_name='';

    public string $alive_text='None - still alive';

    protected $listeners = [
        'openBeeFamilyDetailsModal' => 'openModal',
    ];

    public function openModal($bee_family_id)
    {
        try{
            $this->reset();
            $this->loadData($bee_family_id);
            $this->isModalOpen = true;
        }
        catch(ModelNotFoundException $e){
            flash("Couldn't find that beefamily.")->error()->livewire($this);
        }
    }
    public function loadData($bee_family_id)
    {
        $bee_family = BeeFamily::withTrashed()->findOrFail($bee_family_id);
        $this->bee_family_id = $bee_family_id;
        $this->acquired_at = Carbon::parse($bee_family->acquired_at)->format('Y-m-d');
        $this->population = $bee_family->population;

        if($bee_family->die_off_date!=null){
            $this->die_off_date = Carbon::parse($bee_family->die_off_date)->format('Y-m-d');
        }else{
            $this->die_off_date = $this->alive_text;
        }
        $this->species_name = $bee_family->species_name;
        if($bee_family->hive_id!=null){
            $this->hive_id = $bee_family->hive_id;
        }
        if($this->hive_id!=null){
            //load hive info
            $this->choosen_hive_info="there is hive";
            if($bee_family->hive!=null){
                if($bee_family->hive->apiary_code_name!=null)
                $this->hive_apiary_code_name=$bee_family->hive->apiary_code_name;
                else
                    $this->hive_apiary_code_name='Apiary unassigned - on storage';
            }
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedBeeFamilyDetailsModal');
    }

    public function openBeeFamilyAssignHiveModal()
    {
        $this->closeModal();
        $this->emit('openBeeFamilyAssignHiveModal', $this->bee_family_id);
    }

    public function render()
    {
        return view('livewire.bee-family.details-modal', []);
    }

}
