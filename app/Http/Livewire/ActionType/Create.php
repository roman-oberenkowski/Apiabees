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
        //find trashed action with that name
        $old_record=ActionType::withTrashed()->find($this->name);
        if($old_record!=null){
            //trashed action with that name already exists, restore it!
            $old_record->restore();
            flash("Action type {$this->name} has been created (restored).")->session();
        }else{
            //no trashed action with that name -> create
            $actiontype= ActionType::create($validated);
            $actiontype->save();
            flash("Action type {$this->name} has been created.")->session();
        }
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
