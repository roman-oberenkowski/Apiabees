<?php

namespace App\Http\Livewire\FamilyState;

use App\Models\BeeFamily;
use App\Models\FamilyState;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Livewire\Component;
use Livewire\WithPagination;

class IndexModal extends Component
{
    use WithPagination;
    public bool $isModalOpen = false;
    public string $bee_family_id = '';


    protected $listeners = [
        'openFamilyStateIndexModal' => 'openModal'
    ];

    public function openModal($bee_family_id)
    {
        try{
            $this->reset();
            $bee_family = BeeFamily::withTrashed()->findOrFail($bee_family_id);
            $this->bee_family_id=$bee_family_id;
            $this->isModalOpen = true;
        }
        catch(ModelNotFoundException $e){
            flash("Couldn't find that beefamily.")->error()->livewire($this);
        }
    }

    public function formatDescription($in){
        if(strlen($in)>32)
            return substr($in,0,29).'...';
        return $in;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedFamilyStateIndexModal');
    }

    public function openFamilyStateDetailsModal($id){
        $this->emit('openFamilyStateDetailsModal',$id);
    }

    public function render()
    {
        return view('livewire.family-states.index-modal',
            ['states'=> FamilyState::where('bee_family_id',$this->bee_family_id)->orderBy('checked_at', 'desc')->paginate(2)]);
    }

}
