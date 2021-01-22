<?php

namespace App\Http\Livewire\BeeFamily;

use App\Models\BeeFamily;
use App\Models\Hive;
use App\Models\Specie;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class Create extends Component
{
    public string $acquired_at='';
    public string $population='';
    public ?string $die_off_date=null;
    public string $species_name='';
    public string $hive_id='';
    public array $species_dropdown=[];
    public string $choosen_hive_info='';


    protected function rules()
    {
        return BeeFamily::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validated = $this->validate();
        $validated['die_off_date']=null;
        if($validated['hive_id']!=null){
            try{
                $hive=Hive::findOrFail($validated['hive_id']);
                if($hive->bee_family_id!=null){
                    $this->addError('hive_id','Selected hive is already occupied!');
                    return;
                }
            }catch(ModelNotFoundException $e) {
                $this->addError('hive_id','Cannot find selected hive!');
                return;
            }
            $beefamily = BeeFamily::create($validated);
            $beefamily->save();
            $hive->bee_family_id=$beefamily->id;
            $hive->save();
        }
        else{
            $validated['hive_id']=null; //don't know why, but without it, it doesn't work
            $beefamily = BeeFamily::create($validated);
            $beefamily->hive_id=null;
            $beefamily->save();
        }
        flash("New bee family has been added to the database")->session();
        $this->afterStore();
    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('newBeeFamilyCreated');
        return redirect()->route('bee-families.index');
    }

    public function mount(){
        $this->acquired_at=Carbon::parse(today())->format('Y-m-d');
        $species_temp = Specie::get('name');
        $this->species_dropdown = [];
        foreach ($species_temp as $specie) {
            $this->species_dropdown[] = ['name' => $specie->name, 'value' => $specie->name, 'checked' => false];
        }
        if(isset($this->species_dropdown[0])){
            $this->species_name=$this->species_dropdown[0]['name'];
        }
    }

    public function render()
    {
        return view('livewire.bee-family.create', [
        ]);
    }

    protected $listeners=[
        'HiveChooseModalChoosen'=>'hiveChoosen',
    ];

    public function chooseHive(){
        $this->emit('openHiveChooseModal');
    }

    public function hiveChoosen($choosen_hive){
        $hive=Hive::find($choosen_hive);
        if(isset($hive)){
            $this->hive_id=$choosen_hive;
            $this->validateOnly('hive_id');
        }
    }

    public function openHiveDetailsModal(){
        if($this->hive_id!=null)
            $this->emit('openHiveDetailsModal',$this->hive_id);
    }
    public function resetSelectedHive(){
        $this->hive_id='';
    }
}
