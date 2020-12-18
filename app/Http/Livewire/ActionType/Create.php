<?php

namespace App\Http\Livewire\ActionType;

use App\Models\Action;
use App\Models\ActionType;
use Livewire\Component;

class Create extends Component
{
    public string $name='';
    /**
     * The validation rules
     *
     * @return void
     */
    protected function rules(){
        return ActionType::validationRulesCreate();
    }

    /**
     * Validates data online
     *
     * @param $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Create Employee and User function.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {

        $validated = $this->validate();
        $old_action=ActionType::withTrashed()->find($this->name);
        if($old_action!=null){
            if($old_action->deleted_at!=null){
                //trashed action with that name already exists, restore it!
                $old_action->restore();
                $old_action->save();
                flash("Action type {$this->name} has been created (restored).")->session();
                return redirect()->route('action-types.index');
            }
            else
                $this->addError('name', 'That action type already exists');
                return;

        }
        $actiontype= ActionType::create($validated);
        $actiontype->save();

        flash("Action type {$this->name} has been created.")->session();
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
