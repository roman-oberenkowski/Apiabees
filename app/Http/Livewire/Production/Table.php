<?php

namespace App\Http\Livewire\Production;

use App\Models\ActionType;
use App\Models\Apiary;
use App\Models\Employee;
use App\Models\HoneyProduction;
use App\Models\HoneyType;
use App\Models\WaxProduction;
use Livewire\Component;
use App\Models\Action;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public bool $isHoney = true;
    public array $isHoney_dropdown=[];
    public string $honey_type_name='';
    public array $honey_type_name_dropdown=[];
    public string $apiary_code_name='';
    public array $apiary_code_name_dropdown=[];
    public string $from_date='';
    public string $to_date='';

    protected $listeners = [
        'closedProductionDeleteModal' => '$refresh',
    ];

    public function mount()
    {
        $this->resetPage();
        $this->setup_dropdowns();
    }
    public function setup_dropdowns(){
        $this->apiary_code_name_dropdown=[];
        $apiaries=Apiary::get(['code_name']);
        $this->apiary_code_name_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        foreach ($apiaries as $apiary) {
            $this->apiary_code_name_dropdown[] = ['name' => $apiary->code_name, 'value' => $apiary->code_name, 'checked' => false];
        }

        $this->honey_type_name_dropdown=[];
        $honey_types=HoneyType::get(['name']);
        $this->honey_type_name_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        foreach ($honey_types as $ht) {
            $this->honey_type_name_dropdown[] = ['name' => $ht->name, 'value' => $ht->name, 'checked' => false];
        }
        $this->isHoney_dropdown= [
            ['name' => 'Honey', 'value' => true, 'checked' => false],
            ['name' => 'Wax', 'value' => false, 'checked' => false]
        ];

    }
    public function resetFilters(){
        $this->from_date='';
        $this->to_date='';
        $this->honey_type_name='';
        $this->apiary_code_name='';
    }

    public function get_data(){
        if($this->isHoney){
            return HoneyProduction::
                where('apiary_code_name', 'like', "%{$this->apiary_code_name}%")->
                where('honey_type_name', 'like', "%{$this->honey_type_name}%")->
                when($this->to_date, function($query,$date){
                        return $query->whereDate('produced_at','<=', $date);
                    })->
                when($this->from_date, function($query,$date){
                    return $query->whereDate('produced_at','>=', $date);
                })->
                orderBy('produced_at', 'desc')->
                orderBy('apiary_code_name', 'asc')->
                paginate(10);
        }
        else{
            return WaxProduction::
                where('apiary_code_name', 'like', "%{$this->apiary_code_name}%")->
                when($this->to_date, function($query,$date){
                    return $query->whereDate('produced_at','<=', $date);
                })->
                when($this->from_date, function($query,$date){
                    return $query->whereDate('produced_at','>=', $date);
                })->
                orderBy('produced_at', 'desc')->
                orderBy('apiary_code_name', 'asc')->
                paginate(10);
        }
    }
    public function openProductionDeleteModal($id){
        if($this->isHoney)
            $this->emit('openHoneyProductionDeleteModal',$id);
        else
            $this->emit('openWaxProductionDeleteModal',$id);
    }

    public function render()
    {

        return view(
            'livewire.production.table',
                [
                    'productions' => $this->get_data()
                ]
        );

    }
}
