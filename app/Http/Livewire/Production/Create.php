<?php

namespace App\Http\Livewire\Production;

use App\Models\ActionType;
use App\Models\Apiary;
use App\Models\Employee;
use App\Models\HoneyProduction;
use App\Models\HoneyType;
use App\Models\TaskType;
use App\Models\WaxProduction;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public bool $isHoney = true;
    public array $isHoney_dropdown=[];
    public string $produced_weight='';
    public string $honey_type_name='';
    public array $honey_type_name_dropdown=[];
    public string $apiary_code_name='';
    public array $apiary_code_name_dropdown=[];
    public string $produced_at='';

    protected function rules()
    {
        $rules_honey=[
            'produced_weight'=>['required','numeric','gt:0','lt:10000','regex:/^\d*(.\d{1,2})?$/'],
            'apiary_code_name' => ['required','exists:apiaries,code_name'],
            'honey_type_name'=>['required','exists:honey_types,name'],
            'produced_at' => ['required', 'date', 'before_or_equal:today'],
        ];
        $rules_wax=[
            'produced_weight'=>['required','numeric','gt:0','lt:10000','regex:/^\d*(.\d{1,2})?$/'],
            'apiary_code_name' => ['required','exists:apiaries,code_name'],
            'produced_at' => ['required', 'date', 'before_or_equal:today'],
        ];
        if($this->isHoney)return $rules_honey;
        else return $rules_wax;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(){
        $this->setup_dropdowns();
        $this->produced_at=Carbon::now()->toDateString();
    }

    public function setup_dropdowns(){
        $this->apiary_code_name_dropdown=[];
        $apiaries=Apiary::get(['code_name']);
        $this->apiary_code_name_dropdown[] = ['name' => '', 'value' => '', 'checked' => false];
        foreach ($apiaries as $apiary) {
            $this->apiary_code_name_dropdown[] = ['name' => $apiary->code_name, 'value' => $apiary->code_name, 'checked' => false];
        }

        $this->honey_type_name_dropdown=[];
        $honey_types=HoneyType::get(['name']);
        $this->honey_type_name_dropdown[] = ['name' => '', 'value' => '', 'checked' => false];
        foreach ($honey_types as $ht) {
            $this->honey_type_name_dropdown[] = ['name' => $ht->name, 'value' => $ht->name, 'checked' => false];
        }
        $this->isHoney_dropdown= [
            ['name' => 'Honey', 'value' => true, 'checked' => false],
            ['name' => 'Wax', 'value' => false, 'checked' => false]
        ];

    }

    public function store()
    {
        if($this->isHoney){
            $validated = $this->validate();
            $today_prod=HoneyProduction::where('produced_at',$this->produced_at)->where('apiary_code_name',$this->apiary_code_name)->first();
            if($today_prod!=null){
                $this->addError('apiary_code_name','That apiary already has honey production for selected day!');
                return;
            }
            $hp=HoneyProduction::create($validated);
            $hp->save();
        }else{
            $validated = $this->validate();
            $today_prod=WaxProduction::where('produced_at',$this->produced_at)->where('apiary_code_name',$this->apiary_code_name)->first();
            if($today_prod!=null){
                $this->addError('apiary_code_name','That apiary already has wax production for selected day!');
                return;
            }
            $wp=WaxProduction::create($validated);
            $wp->save();
        }
        flash("Production has been saved.")->success()->livewire($this);
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('newProductionCreated');
        $this->mount();
        //return redirect()->route('productions.index');
    }

    public function render()
    {
        return view('livewire.production.create');
    }
}
