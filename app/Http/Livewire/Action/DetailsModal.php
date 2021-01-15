<?php

namespace App\Http\Livewire\Action;

use App\Models\Action;
use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DetailsModal extends Component
{
    public bool $isModalOpen = false;
    public string $action_id='';
    public string $hive_id='';
    public string $employee='';
    public string $performed_at='';
    public string $description='';
    public string $type_name='';


    protected $listeners = [
        'openActionDetailsModal' => 'openModal',
    ];

    public function openModal($action_id)
    {
        try{
            $action=Action::findOrFail($action_id);
            $emp=Employee::findOrFail($action->employee_PESEL);
            $this->employee=$emp->first_name.' '.$emp->last_name;
            $this->action_id=$action_id;
            $this->performed_at=$action->performed_at;
            $this->hive_id=$this->loadOpt($action->hive_id);
            if($action->description==null){
                $this->description='None';
            }else{
                $this->description=$action->description;
            }
            $this->type_name=$action->type_name;

            $this->isModalOpen = true;
        }
        catch(ModelNotFoundException $e){
            flash("Couldn't find that action.")->error()->livewire($this);
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
        $this->emit('closedActionDetailsModal');
    }

    public function render(){
        return view('livewire.action.details-modal');
    }

    public function redirectApiariesHivesIndex(){
        session(['hives_selected_apiary'=>$this->action_id]);
        return redirect()->route('actions.index');
    }

}
