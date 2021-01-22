<?php

namespace App\Http\Livewire\Hive;

use App\Models\Apiary;
use App\Models\Hive;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditModal extends Component
{
    public bool $isModalOpen = false;
    public string $hive_id='';

    public string $material='';
    public string $nfc_tag='';
    public string $qr_code='';
    public string $apiary_code_name='';
    public string $location_row='';
    public string $location_column='';

    public array $material_dropdown=[];
    public array $apiary_code_name_dropdown=[];

    protected $listeners = [
        'openHiveEditModal' => 'openModal',
    ];

    public function loadScanNFCQR(){
        $user=User::find(Auth::id());
        if($user!=null){
            if($user->last_scanned_nfc!=null){
                $this->nfc_tag=$user->last_scanned_nfc;
            }
            if($user->last_scanned_qr!=null){
                $this->qr_code=$user->last_scanned_qr;
            }
        }
    }

    protected function rules(){
        return [
            'material' => ['required','string','min:2','max:31'],
            'nfc_tag' => ['nullable','string','min:2, max:127',Rule::unique('hives','nfc_tag')->ignore($this->hive_id)],
            'qr_code' => ['nullable','string','min:2, max:31',Rule::unique('hives','qr_code')->ignore($this->hive_id)],
            'apiary_code_name' => ['nullable','string', 'exists:apiaries,code_name','required_with:location_row','required_with:location_column'],
            'location_row'=> ['nullable','integer','gte:1', 'lte:1000','required_with:apiary_code_name','required_with:location_column'],
            'location_column'=> ['nullable','integer','gte:1', 'lte:1000', 'required_with:apiary_code_name','required_with:location_row']
        ];
    }

    public function openModal($id)
    {
        $this->reset();
        try {
            $hive=Hive::findOrFail($id);
            $this->hive_id=$id;
            $this->material=$hive->material;
            $this->nfc_tag=$this->loadOpt($hive->nfc_tag);
            $this->qr_code=$this->loadOpt($hive->qr_code);
            $this->apiary_code_name=$this->loadOpt($hive->apiary_code_name);
            $this->location_column=$this->loadOpt($hive->location_column);
            $this->location_row=$this->loadOpt($hive->location_row);
            $this->setup_dropdowns();
        }catch (ModelNotFoundException $e){
            flash("Couldn't find that hive.")->error()->livewire($this);
        }
        $this->isModalOpen = true;
    }

    public function setup_dropdowns()
    {
        $this->apiary_code_name_dropdown = [];
        $apiaries = Apiary::get(['code_name']);
        $this->apiary_code_name_dropdown[] = ['name' => 'Unassigned', 'value' => '', 'checked' => false];
        foreach ($apiaries as $apiary) {
            $this->apiary_code_name_dropdown[] = ['name' => $apiary->code_name, 'value' => $apiary->code_name, 'checked' => false];
        }
        $available_materials=['Metal','Plastic','Wood','Other'];
        $this->material_dropdown=[];

        foreach ($available_materials as $type) {
            $this->material_dropdown[] = ['name' => $type, 'value' => $type, 'checked' => false];
        }
    }

    public function closeModal(){
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = false;
    }

    public function choose(){
        $validated=$this->validate();
        $error=false;
        if($validated['apiary_code_name']!=null) {
            $check_position = Hive::where('apiary_code_name', $this->apiary_code_name)
                ->where('location_row', $this->location_row)
                ->where('location_column', $this->location_column)
                ->where('id','!=',$this->hive_id)
                ->first();
            if ($check_position != null) {
                $this->addError('location_row', "That spot is already taken by another hive!");
                $error=true;
            }
            $apiary_dims=Apiary::findOrFail($this->apiary_code_name);
            if($this->location_row>$apiary_dims->row_num){
                $this->addError('location_row', "The max available row is {$apiary_dims->row_num}");
                $error=true;
            }
            if($this->location_column>$apiary_dims->col_num){
                $this->addError('location_column', "The max available column is {$apiary_dims->col_num}");
                $error=true;
            }
            if($error)return;
        }
        else{
            $validated['apiary_code_name']=null;
            $validated['location_column']=null;
            $validated['location_row']=null;
        }
        try {
            $hive=Hive::findOrFail($this->hive_id);
            $hive->update($validated);
        }catch (ModelNotFoundException $e){
            flash("Couldn't find that hive.")->error()->livewire($this);
            return;
        }
        flash("Hive edited.")->success()->livewire($this);
        $this->emit('HiveEditModalEdited');
        $this->emit('HiveEditModalClosed');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.hive.edit-modal');
    }

    public function loadOpt($opt){
        if($opt==null)return '';
        return $opt;
    }
}
