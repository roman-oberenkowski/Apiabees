<?php

namespace App\Http\Livewire\Apiary;

use App\Models\Apiary;
use Livewire\Component;

class Create extends Component
{
    protected $listeners=[];
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

    protected function rules()
    {
        return Apiary::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validated = $this->validate();
        $apiary = Apiary::create($validated);
        $apiary->save();
        flash("New apiary has been created")->success()->livewire($this);
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('newApiaryCreated');
        return redirect()->route('apiaries.index');
    }

    public function mount(){
//        $this->setDefaultDropdownValues();
    }

    public function render()
    {
        return view('livewire.apiary.create', [

        ]);
    }
}
