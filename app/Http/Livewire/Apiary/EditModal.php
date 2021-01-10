<?php

namespace App\Http\Livewire\Apiary;

use App\Models\Apiary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditModal extends Component
{
    public bool $isModalOpen = false;

    public string $old_code_name='';
    public string $code_name='';
    public string $name='';
    public string $area='';
    public string $city='';
    public string $street='';
    public string $parcel='';
    public string $latitude='';
    public string $longitude='';
    public string $row_num='';
    public string $col_num='';

    protected $listeners = [
        'openApiaryEditModal' => 'openModal',
    ];

    protected function rules()
    {
        $rules = Apiary::validationRulesUpdate();
        $rules['code_name'] = ['required', 'string', 'min:2','max:31',Rule::unique('apiaries','code_name')->ignore($this->old_code_name,'code_name')];
        $rules['name'] = ['required', 'string', 'min:2','max:63',Rule::unique('apiaries','name')->ignore($this->old_code_name,'code_name')];
        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $validated=$this->validate();


        try {
            $apiary = Apiary::findOrFail($this->old_code_name);
            $apiary->update($validated);
            $apiary->save();
            flash("Apiary successsfully updated.")->success()->livewire($this);
            $this->closeModal();
        } //catching for example concurrent start edit, other user deletes and first try to save
        catch (ModelNotFoundException $e) {
            flash("Cannot edit chosen user. Please check if apiary is still in the database and try again")->error()->livewire($this);
            $this->closeModal();
        }

    }

    public function openModal($code_name)
    {
        $this->resetValidation();
        $this->reset();
        $this->loadData($code_name);
        $this->isModalOpen = true;
    }

    public function loadData($code_name)
    {
        $apiary=Apiary::findOrFail($code_name);
        $this->old_code_name=$code_name;
        $this->code_name=$code_name;
        $this->name=$apiary->name ;
        $this->area=$apiary->area ;
        $this->city=$apiary-> city;
        $this->street=$apiary->street ;
        $this->parcel=$apiary->parcel ;
        $this->latitude=$apiary->latitude ;
        $this->longitude=$apiary->longitude ;
        $this->row_num=$apiary->row_num ;
        $this->col_num=$apiary->col_num;
    }

    public function closeModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = false;
        $this->emit('closedApiaryEditModal');
    }

    public function render()
    {
        return view('livewire.apiary.edit-modal');
    }
}
