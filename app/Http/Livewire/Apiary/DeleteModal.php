<?php

namespace App\Http\Livewire\Apiary;

use App\Models\Apiary;
use App\Models\Hive;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DeleteModal extends Component
{
    public bool $isModalOpen = false;
    public string $apiary_code_name='';
    protected $listeners = [
        'openApiaryDeleteModal' => 'openModal',
    ];

    public function openModal($input_code_name)
    {
        $this->reset();
        $this->resetValidation();
        try {
            Apiary::findOrFail($input_code_name);
            $this->apiary_code_name=$input_code_name;
            $this->isModalOpen = true;
        } catch (ModelNotFoundException $e) {
            flash("Couldn't find that Apiary. Already deleted?")->info()->livewire($this);
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedApiaryDeleteModal');
    }

    public function destroy()
    {
        try {
            $tbd=Apiary::findOrFail($this->apiary_code_name);
            //move all hives to storage before apiary deletion
            Hive::where('apiary_code_name', $this->apiary_code_name)
                ->update(['apiary_code_name' => null,'location_row'=>null, 'location_column'=>null]);
            $tbd->delete();
            flash("Apiary has been deleted.")->success()->livewire($this);
        }
        catch (ModelNotFoundException $e) {
            flash("Couldn't find that Apiary. Already deleted?")->info()->livewire($this);
        }
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.apiary.delete-modal');
    }
}
