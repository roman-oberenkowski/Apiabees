<?php

namespace App\Http\Livewire\Hive;

use App\Models\Apiary;
use App\Models\Hive;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class MoveModal extends Component
{
    public bool $isModalOpen = false;
    public string $hive_id='';

    public string $old_apiary_code_name='';
    public string $old_location_row='';
    public string $old_location_column='';

    public string $apiary_code_name='';
    public string $location_row='';
    public string $location_column='';

    public array $apiary_code_name_dropdown=[];

    protected $listeners = [
        'openHiveMoveModal' => 'openModal',
    ];

    protected function rules(){
        $rules=Hive::validationRulesUpdate();
        $rules_new=[];
        $rules_new['apiary_code_name']=$rules['apiary_code_name'];
        $rules_new['location_row']=$rules['location_row'];
        $rules_new['location_column']=$rules['location_column'];
        return $rules_new;
    }

    public function openModal($id)
    {
        $this->reset();
        try {
            $hive=Hive::findOrFail($id);
            $this->hive_id=$id;
            $this->old_apiary_code_name=$this->loadOpt($hive->apiary_code_name);
            $this->old_location_column=$this->loadOpt($hive->location_column);
            $this->old_location_row=$this->loadOpt($hive->location_row);
            $this->setup_apiary_dropdown();
        }catch (ModelNotFoundException $e){
            flash("Couldn't find that hive.")->error()->livewire($this);
        }
        $this->isModalOpen = true;
    }

    public function setup_apiary_dropdown()
    {
        $this->apiary_code_name_dropdown = [];
        $apiaries = Apiary::get(['code_name']);
        $this->apiary_code_name_dropdown[] = ['name' => 'Unassigned', 'value' => '', 'checked' => false];
        foreach ($apiaries as $apiary) {
            $this->apiary_code_name_dropdown[] = ['name' => $apiary->code_name, 'value' => $apiary->code_name, 'checked' => false];
        }
    }

    public function closeModal(){
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = false;
    }

    public function choose(){
        $validated=$this->validate();
        $error=false;
        if($validated['apiary_code_name']!=null) {
            $check_position = Hive::where('apiary_code_name', $this->apiary_code_name)
                ->where('location_row', $this->location_row)
                ->where('location_column', $this->location_column)
                ->first();
            if ($check_position != null) {
                $this->addError('location_row', "That spot is already taken by another hive!");
                $error=true;
            }
            $apiary_dims=Apiary::findOrFail($this->apiary_code_name);
            if($this->location_row>$apiary_dims->row_num){
                $this->addError('location_row', "The max available row is {$apiary_dims->row_num}");
                $error=true;
            }
            if($this->location_column>$apiary_dims->col_num){
                $this->addError('location_column', "The max available column is {$apiary_dims->col_num}");
                $error=true;
            }
            if($error)return;
        }
        else{
            $validated['apiary_code_name']=null;
            $validated['location_column']=null;
            $validated['location_row']=null;
        }
        try {
            $hive=Hive::findOrFail($this->hive_id);
            $hive->update($validated);
        }catch (ModelNotFoundException $e){
            flash("Couldn't find that hive.")->error()->livewire($this);
            return;
        }
        flash("Hive moved.")->success()->livewire($this);
        $this->emit('HiveMoveModalMoved');
        $this->emit('HiveMoveModalClosed');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.hive.move-modal');
    }

    public function loadOpt($opt){
        if($opt==null)return "Unassigned";
        return $opt;
    }
}
