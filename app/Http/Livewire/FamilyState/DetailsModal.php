<?php

namespace App\Http\Livewire\FamilyState;

use App\Models\Action;
use App\Models\Employee;
use App\Models\FamilyState;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DetailsModal extends Component
{
    public bool $isModalOpen = false;
    public string $family_state_id='';
    public string $checked_at='';
    public string $inspection_description='';
    public string $bee_family_id='';
    public string $state_type_name='';


    protected $listeners = [
        'openFamilyStateDetailsModal' => 'openModal',
    ];

    public function openModal($family_state_id)
    {
        try{
            $state=FamilyState::findOrFail($family_state_id);
            $this->family_state_id = $family_state_id;
            $this->checked_at = $state->checked_at;
            $this->inspection_description = $this->loadOpt($state->inspection_description);
            $this->bee_family_id = $this->loadOpt($state->bee_family_id);
            $this->state_type_name = $state->state_type_name;



            $this->isModalOpen = true;
        }
        catch(ModelNotFoundException $e){
            flash("Couldn't find that family state.")->error()->livewire($this);
        }
    }
    public function loadOpt($in){
        if($in==null){
            return '';
        }
        return $in;
    }

    public function closeModal(){
        $this->isModalOpen = false;
        $this->emit('closedFamilyStatesDetailsModal');
    }

    public function render(){
        return view('livewire.family-states.details-modal');
    }
}
