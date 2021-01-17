<?php

namespace App\Http\Livewire\Hive;

use App\Models\Apiary;
use App\Models\Hive;
use Livewire\Component;

class Create extends Component
{
    protected $listeners=[];
    public string $material='';
    public string $nfc_tag='';
    public string $qr_code='';
    public string $apiary_code_name='';
    public string $location_row='';
    public string $location_column='';

    public array $material_dropdown=[];
    public array $apiary_code_name_dropdown=[];

    protected function rules()
    {
        return Hive::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function setup_dropdowns(){
        $this->apiary_code_name_dropdown=[];
        $apiaries=Apiary::get(['code_name']);
        $this->apiary_code_name_dropdown[] = ['name' => '', 'value' => '', 'checked' => false];
        foreach ($apiaries as $apiary) {
            $this->apiary_code_name_dropdown[] = ['name' => $apiary->code_name, 'value' => $apiary->code_name, 'checked' => false];
        }
        $available_materials=['Metal','Plastic','Wood','Other'];
        $this->material_dropdown=[];

        foreach ($available_materials as $type) {
            $this->material_dropdown[] = ['name' => $type, 'value' => $type, 'checked' => false];
        }
        $this->material=$available_materials[0];

    }

    public function store()
    {
        $validated = $this->validate();
        $error=false;
        if($validated['apiary_code_name']!=null) {
            $check_position = Hive::where('apiary_code_name', $this->apiary_code_name)
                ->where('location_row', $this->location_row)
                ->where('location_column', $this->location_column)
                ->first();
            if ($check_position != null) {
                $this->addError('location_row', "That spot is already taken by another hive!");
                return;
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
        $hive = Hive::create($validated);
        $hive->save();
        flash("New hive has been created")->session();
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('newHiveCreated');
        return redirect()->route('hives.index');
    }

    public function mount(){
        $this->setup_dropdowns();

    }

    public function render()
    {
        return view('livewire.hive.create', [

        ]);
    }
}
