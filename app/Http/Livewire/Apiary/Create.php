<?php

namespace App\Http\Livewire\Apiary;

use App\Models\Apiary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    protected $listeners=[];

    protected function rules()
    {
        return Apiary::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        if($propertyName=='type_name')
            $this->resetValidation();
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
        $this->emit('newActionCreated');
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
