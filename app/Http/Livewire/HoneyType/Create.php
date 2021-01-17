<?php

namespace App\Http\Livewire\HoneyType;

use App\Models\HoneyType;
use Livewire\Component;

class Create extends Component
{
    public string $name='';

    protected function rules()
    {
        return HoneyType::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validated = $this->validate();
        $honey_type= HoneyType::create($validated);
        $honey_type->save();
        flash("Honey type {$this->name} has been created.")->success()->session();
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('newHoneyTypeCreated');
        return redirect()->route('honey-types.index');
    }

    public function render()
    {
        return view('livewire.honey-type.create');
    }
}
