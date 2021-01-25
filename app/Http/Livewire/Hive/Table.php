<?php

namespace App\Http\Livewire\Hive;

use App\Models\Apiary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Hive;
use Livewire\WithPagination;


class Table extends Component
{
    use WithPagination;
    public array $filter_apiary_code_name_dropdown=[];
    public string $filter_apiary_code_name='';
    public string $filter_state='';
    public array $filter_state_dropdown=[];
    public string $filter_qr='';
    public string $filter_nfc='';

    protected $listeners = [
        'closedHiveDeleteModal' => '$refresh',
        'HiveEditModalEdited' => '$refresh'
    ];

    public function updated($propertyName){
        $this->resetPage();
    }

    public function resetFilters(){
        $this->filter_apiary_code_name='';
        $this->filter_state='';
        $this->filter_qr='';
        $this->filter_nfc='';
    }

    public function loadScanNFCQR(){
        $user=User::find(Auth::id());
        if($user!=null){
            if($user->last_scanned_nfc!=null){
                $this->filter_nfc=$user->last_scanned_nfc;
            }
            if($user->last_scanned_qr!=null){
                $this->filter_qr=$user->last_scanned_qr;
            }
        }
    }

    public function mount()
    {
        $this->resetPage();
        $this->setup_apiary_dropdown();
        $this->setup_state_dropdown();
        if(session()->has('hives_selected_apiary')){
            $this->filter_apiary_code_name=session()->pull('hives_selected_apiary');
        }
    }

    public function setup_apiary_dropdown(){
        $this->filter_apiary_code_name_dropdown=[];
        $this->filter_apiary_code_name_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        $this->filter_apiary_code_name_dropdown[] = ['name' => 'Unassigned', 'value' => 'Unassigned', 'checked' => false];
        $apiaries=Apiary::get(['code_name']);
        foreach ($apiaries as $apiary) {
            $this->filter_apiary_code_name_dropdown[] = ['name' => $apiary->code_name, 'value' => $apiary->code_name, 'checked' => false];
        }
    }

    public function setup_state_dropdown(){
        $this->filter_state_dropdown=[];
        $this->filter_state_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        $this->filter_state_dropdown[] = ['name' => 'Empty', 'value' => 'Empty', 'checked' => false];
        $this->filter_state_dropdown[] = ['name' => 'Occupied', 'value' => 'Occupied', 'checked' => false];

    }
    public function get_hives(){
        $pages_num=10;
        return Hive::
            when($this->filter_apiary_code_name, function($query,$apcn){
                if($apcn=='Unassigned')
                    return $query->whereNull('apiary_code_name');
                else
                    return $query->where('apiary_code_name', $apcn);
            })
            ->when($this->filter_state, function($query,$apcn){
                if($apcn=='Empty')
                    return $query->whereNull('bee_family_id');
                else
                    return $query->whereNotNull('bee_family_id');
            })->
            when($this->filter_nfc, function($query,$filter_nfc){
                if($filter_nfc!=null)
                    return $query->where('nfc_tag', 'like', "%{$filter_nfc}%");
                else
                    return $query;
            })->
            when($this->filter_qr, function($query,$filter_qr){
                if($filter_qr!=null)
                    return $query->where('qr_code', 'like', "%{$filter_qr}%");
                else
                    return $query;
            })->
            paginate($pages_num);

    }

    public function render()
    {
        return view(
            'livewire.hive.table',
                [
                    'hives' => $this->get_hives()
                ]
        );
    }

    public function openHiveDeleteModal($id){
        $this->emit('openHiveDeleteModal', $id);
    }
    public function openHiveEditModal($id){
        $this->emit('openHiveEditModal', $id);
    }
    public function openHiveDetailsModal($id){
        $this->emit('openHiveDetailsModal', $id);
    }
}
