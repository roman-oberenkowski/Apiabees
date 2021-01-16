<?php

namespace App\Http\Livewire\Hive;

use App\Models\Apiary;
use App\Models\Hive;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DetailsModal extends Component
{
    public bool $isModalOpen = false;
    public string $hive_id='';
    public string $material='';
    public string $nfc_tag='';
    public string $qr_code='';
    public string $apiary_code_name='';
    public string $location_row='';
    public string $location_column='';
    public string $bee_family_id='';


    protected $listeners = [
        'openHiveDetailsModal' => 'openModal',
    ];

    public function openModal($input_hive_id)
    {
        try{
            $hive=Hive::findOrFail($input_hive_id);
            $this->hive_id=$input_hive_id;
            $this->material=$hive->material;
            $this->nfc_tag=$this->loadOpt($hive->nfc_tag);
            $this->qr_code=$this->loadOpt($hive->qr_code);
            $this->apiary_code_name=$this->loadOpt($hive->apiary_code_name);
            $this->location_row=$this->loadOpt($hive->location_row);
            $this->location_column=$this->loadOpt($hive->location_column);
            $this->bee_family_id=$this->loadOpt($hive->bee_family_id);

            $this->isModalOpen = true;
        }
        catch(ModelNotFoundException $e){
            flash("Couldn't find that hive.")->error()->livewire($this);
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedHiveDetailsModal');
    }

    public function loadOpt($in){
        if($in==null)return '';
        return $in;
    }

    public function render()
    {
        return view('livewire.hive.details-modal', []);
    }
}
