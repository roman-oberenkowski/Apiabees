<?php

namespace App\Http\Livewire\StateType;

use App\Models\StateType;
use Livewire\Component;

class Create extends Component
{
    public string $name='';

    protected function rules()
    {
        return StateType::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validated = $this->validate();
        $task_type= StateType::create($validated);
        $task_type->save();
        flash("State type {$this->name} has been created.")->success()->session();
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('newStateTypeCreated');
        return redirect()->route('state-types.index');
    }

    public function render()
    {
        return view('livewire.state-type.create');
    }
}
