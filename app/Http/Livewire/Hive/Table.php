<?php

namespace App\Http\Livewire\Hive;

use App\Models\Apiary;
use Livewire\Component;
use App\Models\Hive;
use Livewire\WithPagination;


class Table extends Component
{
    use WithPagination;
    public bool $isModal;
    public bool $isModalOpen=true;
    public array $filter_apiary_code_name_dropdown=[];
    public string $filter_apiary_code_name='';
    public string $filter_state='';
    public array $filter_state_dropdown=[];

    protected $listeners = [
        'closedHiveDeleteModal' => '$refresh',
        'HiveMoveModalMoved' => '$refresh'
    ];

    public function updated($propertyName){
        $this->resetPage();
    }

    public function mount()
    {
        $this->resetPage();
        $this->setup_apiary_dropdown();
        $this->setup_state_dropdown();
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
            })

            ->paginate($pages_num);

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
    public function openHiveMoveModal($id){
        $this->emit('openHiveMoveModal', $id);
    }
}
