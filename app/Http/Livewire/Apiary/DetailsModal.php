<?php

namespace App\Http\Livewire\Apiary;

use App\Models\Apiary;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DetailsModal extends Component
{
    public bool $isModalOpen = false;
    public string $apiary_code_name='';
    public array $apiary=[];
    public string $temp='temp';

    protected $listeners = [
        'openApiaryDetailsModal' => 'openModal',
    ];

    public function openModal($input_code_name)
    {
        try{
            $this->apiary=Apiary::findOrFail($input_code_name)->toArray();
            $this->apiary_code_name=$input_code_name;
            $this->isModalOpen = true;
            $this->render();
        }
        catch(ModelNotFoundException $e){
            flash("Couldn't find that apiary.")->error()->livewire($this);
        }
    }

    public function g($name){
        if(isset($this->apiary[$name])){
            return $this->apiary[$name];
        }
        else{
            return '';
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedApiaryDetailsModalForm');
    }

    public function redirectApiaryActionsIndex()
    {
        session(['actions_selected_apiary'=>$this->PESEL]);
        return redirect()->route('actions.index');
    }

    public function openEditModalForm()
    {
        $id = $this->PESEL;
        $this->closeModal();
        $this->emit('openApiaryEditModalForm', $id);
    }

    public function render()
    {
        return view('livewire.apiary.details-modal', []);
    }

    public function redirectApiariesHivesIndex(){
        session(['hivess_selected_apiary'=>$this->apiary_code_name]);
        return redirect()->route('hives.index');
    }
}
