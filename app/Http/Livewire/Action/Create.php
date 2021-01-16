<?php

namespace App\Http\Livewire\Action;

use App\Models\Action;
use App\Models\ActionType;
use App\Models\Employee;
use App\Models\Hive;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public string $action_id = '';
    public string $employee_PESEL = '';
    public string $description='';
    public $hive_id = null;
    public string $type_name = '';
    public string $choosen_hive_info='Brak';



    protected $listeners=[
        'HiveChooseModalChoosen'=>'hiveChoosen',
        ];




    public function hiveChoosen($choosen_hive){
        $hive=Hive::find($choosen_hive);
        if(isset($hive)){
            $this->hive_id=$choosen_hive;
            $this->choosen_hive_info='Hive_nfc: '.$hive->nfc_tag.' Apiary code name: '.$hive->apiary_code_name;
            $this->validateOnly('hive_id');
            flash("Hive successfully chosen")->success()->livewire($this);
        }
    }


    protected function rules()
    {
        return Action::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        if($propertyName=='type_name')
            $this->resetValidation();
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        //dd($this->getErrorBag());
        $validated = $this->validate();
        if($validated['type_name']==ActionType::special_action_inspection){
            //use description as family state description
            $validated['description']=null;
        }

        $action = Action::create($validated);

        $action->save();
        flash("Your action has been successfully logged.")->success()->livewire($this);
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->setDefaultDropdownValues();
        $this->emit('newActionCreated');
    }

    public function setDefaultDropdownValues(){
        $current_user=User::find(Auth::id());
        if(isset($current_user) && isset($current_user->employee_PESEL))
            $this->employee_PESEL=$current_user->employee_PESEL;
        $this->type_name=ActionType::special_action_other;
    }

    public function mount(){
        $this->setDefaultDropdownValues();
    }


    public function render()
    {
        $type_names_temp = ActionType::get('name');
        $type_names_dropdown = [];
        foreach ($type_names_temp as $type) {
            $type_names_dropdown[] = ['name' => $type->name, 'value' => $type->name, 'checked' => false];
        }
        $employee_temp = Employee::orderBy('last_name')->get(['PESEL', 'first_name', 'last_name']);
        $employee_dropdown = [['name'=>'Choose yourself', 'value'=> '', 'checked'=>false]];

        foreach ($employee_temp as $emp) {
            $employee_dropdown[] = ['name' => $emp->first_name . ' ' . $emp->last_name, 'value' => $emp->PESEL, 'checked' => false];
        }

        return view('livewire.action.create', [
            'employees_dropdown' => $employee_dropdown,
            'type_names_dropdown' => $type_names_dropdown
        ]);
    }

    public function chooseHive(){
        $this->hive_id='';
        $this->emit('openHiveChooseModal');
    }
    public function openHiveDetailsModal(){
        if($this->hive_id!=null)
        $this->emit('openHiveDetailsModal',$this->hive_id);
    }
    public function resetSelectedHive(){
        $this->hive_id='';
    }
}
