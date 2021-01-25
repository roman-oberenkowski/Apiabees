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
        $this->reset();
        $this->resetValidation();
        try{
            $this->apiary=Apiary::findOrFail($input_code_name)->toArray();
            $this->apiary_code_name=$input_code_name;
            $this->isModalOpen = true;
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
        $this->emit('closedApiaryDetailsModal');
    }

    public function openApiaryEditModal()
    {
        $this->closeModal();
        $this->emit('openApiaryEditModal', $this->apiary_code_name);
    }

    public function render()
    {
        return view('livewire.apiary.details-modal', []);
    }

    public function redirectApiariesHivesIndex(){
        session(['hives_selected_apiary'=>$this->apiary_code_name]);
        return redirect()->route('hives.index');
    }

}
