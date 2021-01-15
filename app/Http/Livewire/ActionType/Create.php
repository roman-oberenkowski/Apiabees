<?php

namespace App\Http\Livewire\ActionType;

use App\Models\ActionType;
use Livewire\Component;

class Create extends Component
{
    public string $name='';

    protected function rules()
    {
        return ActionType::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validated = $this->validate();
        $actiontype= ActionType::create($validated);
        $actiontype->save();
        flash("Action type {$this->name} has been created.")->success()->session();
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('newActionTypeCreated');
        return redirect()->route('action-types.index');
    }

    public function render()
    {
        return view('livewire.action-type.create');
    }
}
