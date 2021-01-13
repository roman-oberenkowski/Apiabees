<?php

namespace App\Http\Livewire\BeeFamily;

use App\Models\BeeFamily;
use App\Models\Hive;
use App\Models\Specie;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditModal extends Component
{
    public bool $isModalOpen = false;

    public $bee_family_id = '';
    public string $acquired_at = '';
    public string $population = '';
    public $die_off_date = '';
    public string $species_name = '';
    public $hive_id = '';
    public array $species_dropdown = [];
    public string $choosen_hive_info = '';

    protected $listeners = [
        'openBeeFamilyEditModal' => 'openModal',
    ];

    protected function rules()
    {
        $rules = BeeFamily::validationRulesUpdate();
        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $validated = $this->validate();

        try {
            $beefamily = BeeFamily::findOrFail($this->bee_family_id);


            $beefamily->update($validated);
            $beefamily->save();
            flash("BeeFamily successsfully updated.")->success()->livewire($this);
            $this->closeModal();
        } //catching for example concurrent start edit, other user deletes and first try to save
        catch (ModelNotFoundException $e) {
            flash("Cannot edit chosen bee-family. Please check if bee-family is still in the database and try again")->error()->livewire($this);
            $this->closeModal();
        }

    }

    public
    function openModal($bee_family_id)
    {
        $this->resetValidation();
        $this->reset();
        $this->loadData($bee_family_id);
        $this->isModalOpen = true;

        $species_temp = Specie::get('name');
        $this->species_dropdown = [];
        foreach ($species_temp as $specie) {
            $this->species_dropdown[] = ['name' => $specie->name, 'value' => $specie->name, 'checked' => false];
        }
    }


    public function loadData($bee_family_id)
    {
        $beefamily = BeeFamily::findOrFail($bee_family_id);
        $this->bee_family_id = $bee_family_id;
        if($beefamily->acquired_at!=null){
            $this->acquired_at = Carbon::parse($beefamily->acquired_at)->format('Y-m-d');
        }
        $this->population = $beefamily->population;
        $this->die_off_date = $beefamily->die_off_date==null ? '' : $beefamily->die_off_date;
        if($beefamily->die_off_date!=null){
            $this->die_off_date = Carbon::parse($beefamily->die_off_date)->format('Y-m-d');
        }
        $this->species_name = $beefamily->species_name;
        $this->hive_id = $beefamily->hive_id;
        if($this->hive_id!=null){
            //load hive info
        }
    }

    public function closeModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = false;
        $this->emit('closedBeeFamilyEditModal');
    }

    public function render()
    {
        return view('livewire.bee-family.edit-modal');
    }
}
