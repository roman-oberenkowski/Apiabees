<?php

namespace App\Http\Livewire\Action;

use App\Models\Action;
use App\Models\ActionType;
use App\Models\BeeFamily;
use App\Models\Employee;
use App\Models\FamilyState;
use App\Models\Hive;
use App\Models\StateType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public string $employee_PESEL = '';
    public string $description='';
    public ?int $hive_id = null;
    public string $type_name = '';
    public array $type_name_dropdown=[];
    public array $employee_dropdown=[];
    //inspection
    public string $inspection_description='';
    public ?int $bee_family_id=null;
    public string $state_type_name='';
    public array $state_type_name_dropdown=[];
    public string $population='';


    protected $listeners=[
        'HiveChooseModalChoosen'=>'hiveChoosen',
        ];

    protected function rules()
    {
        $base_rules=[
            'employee_PESEL' => ['required', 'string', 'size:11', Rule::exists('employees','PESEL')],
            'description' => ['nullable','string', 'min:2','max:65000','requiredIf:type_name,'.ActionType::special_action_other],
            'hive_id' => ['nullable', 'integer','exists:hives,id','requiredIf:type_name,'.ActionType::special_action_inspection],
            'type_name' => ['required','exists:action_types,name','max:32'] ];
        if($this->type_name==ActionType::special_action_inspection){
            $insp_rules=[
                'state_type_name' => ['required','exists:state_types,name','max:32'],
                //'bee_family_id'=>['required','exists:bee_families,id','integer'],
                'inspection_description'=>['nullable','string', 'min:2','max:65000','requiredIf:state_type_name,'.StateType::special_state_other],
            ];
            if($this->state_type_name==StateType::special_state_population_changed) {
                $insp_rules['population'] =['required', 'integer','gte:1'];

            }
            return array_merge($base_rules, $insp_rules);
        }
        return $base_rules;

    }

    public function updated($propertyName)
    {
        if($propertyName=='type_name')
            $this->resetValidation();
        $this->validateOnly($propertyName);
    }

    public function noBeeFamilyInHive(){
        $this->addError('hive_id',"That hive is missing a bee family!");
    }

    public function store()
    {
        $validated = $this->validate();
        if($this->type_name==ActionType::special_action_inspection){
            $bee_family=BeeFamily::find($this->bee_family_id);
            if($bee_family==null) {
                $this->noBeeFamilyInHive();
                return;
            }

            $validated['bee_family_id']=$this->bee_family_id;
            if($this->state_type_name==StateType::special_state_population_changed){
                $validated['inspection_description']="To {$this->population}; ".$validated['inspection_description'];
                $bee_family->population=$this->population;
                $bee_family->save();
            }
            if($this->state_type_name==StateType::special_state_family_dead){
                $hive=Hive::find($this->hive_id);
                if($hive!=null){
                    $hive->bee_family_id=null;
                    $hive->save();

                    $bee_family->population=0;
                    $bee_family->die_off_date=Carbon::now();
                    $bee_family->hive_id=null;
                    $bee_family->save();
                }

            }

            $state=new FamilyState($validated);
            $state->save();
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
        $this->emit('newActionCreated');
        $this->mount();
    }

    public function mount(){
        $this->setup_dropdowns();
    }

    public function setup_dropdowns(){
        $type_names_temp = ActionType::get('name');
        $this->type_name_dropdown = [];
        foreach ($type_names_temp as $type) {
            $this->type_name_dropdown[] = ['name' => $type->name, 'value' => $type->name, 'checked' => false];
        }
        $employee_temp = Employee::orderBy('last_name')->get(['PESEL', 'first_name', 'last_name']);
        $this->employee_dropdown = [['name'=>'Choose yourself', 'value'=> '', 'checked'=>false]];

        foreach ($employee_temp as $emp) {
            $this->employee_dropdown[] = ['name' => $emp->first_name . ' ' . $emp->last_name, 'value' => $emp->PESEL, 'checked' => false];
        }
        //default values
        $current_user=User::find(Auth::id());
        if(isset($current_user) && isset($current_user->employee_PESEL))
            $this->employee_PESEL=$current_user->employee_PESEL;
        $this->type_name=ActionType::special_action_other;
        //state types
        $state_types=StateType::get('name');
        $this->state_type_name_dropdown=[];
        foreach($state_types as $state){
            $this->state_type_name_dropdown[]=['name'=>$state->name, 'value'=> $state->name, 'checked'=>false];
        }
        $this->state_type_name=StateType::special_state_other;
    }

    public function render()
    {
        return view('livewire.action.create', []);
    }

    public function openHiveDetailsModal(){
        if($this->hive_id!=null)
        $this->emit('openHiveDetailsModal',$this->hive_id);
    }

    public function chooseHive(){
        $this->emit('openHiveChooseModal');
    }

    public function hiveChoosen($choosen_hive){
        $hive=Hive::find($choosen_hive);
        if(isset($hive)){
            $this->hive_id=$choosen_hive;
            $this->validateOnly('hive_id');
            $bee_family=BeeFamily::find($hive->bee_family_id);
            if($bee_family!=null){
                $this->bee_family_id=$hive->bee_family_id;
                $this->population=$bee_family->population;
            }
            else{
                if($this->type_name==ActionType::special_action_inspection){
                    $this->noBeeFamilyInHive();
                }
            }
        }
    }

    public function resetSelectedHive(){
        $this->hive_id=null;
        $this->bee_family_id=null;
        $this->population='';
    }

}
