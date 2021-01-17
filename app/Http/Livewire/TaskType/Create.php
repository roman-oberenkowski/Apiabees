<?php

namespace App\Http\Livewire\TaskType;

use App\Models\TaskType;
use Livewire\Component;

class Create extends Component
{
    public string $name='';

    protected function rules()
    {
        return TaskType::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validated = $this->validate();
        $task_type= TaskType::create($validated);
        $task_type->save();
        flash("Task type {$this->name} has been created.")->success()->session();
        $this->afterStore();

    }

    public function afterStore()
    {
        $this->reset();
        $this->resetValidation();
        $this->emit('newTaskTypeCreated');
        return redirect()->route('task-types.index');
    }

    public function render()
    {
        return view('livewire.task-type.create');
    }
}
