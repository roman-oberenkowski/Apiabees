<?php

namespace App\Http\Livewire\Specie;

use App\Models\Specie;
use Livewire\Component;

class Create extends Component
{
    public string $name='';
    public string $latin_name='';
    public bool $is_aggressive = false;

    protected function rules()
    {
        return Specie::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function toggleIsAggressive()
    {
        $this->is_aggressive = !$this->is_aggressive;
    }

    public function store()
    {
        $validated = $this->validate();
        $honey_type= Specie::create($validated);
        $honey_type->save();
        flash("Specie {$this->name} has been created.")->success()->session();
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('newSpecieCreated');
        return redirect()->route('species.index');
    }

    public function render()
    {
        return view('livewire.specie.create');
    }
}
