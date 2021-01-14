<?php

namespace App\Http\Livewire\BeeFamily;

use App\Models\Apiary;
use Livewire\Component;
use App\Models\BeeFamily;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public bool $isModalOpen=true;

    public string $filter_state='';
    public array $filter_state_dropdown=[];
    public array $filter_specie_dropdown=[];


    protected $listeners = [
        'closedBeeFamilyDeleteModal' => '$refresh',
        'closedBeeFamilyEditModal' => '$refresh'
    ];

    public function mount()
    {
        $this->resetPage();
        $this->initDropdowns();
    }

    public function initDropdowns(){
        $this->filter_state_dropdown=[];
        $this->filter_state_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        $this->filter_state_dropdown[] = ['name' => 'Dead', 'value' => 'Dead', 'checked' => false];
        $this->filter_state_dropdown[] = ['name' => 'Homeless', 'value' => 'Homeless', 'checked' => false];
        $this->filter_state_dropdown[] = ['name' => 'In hive (storage)', 'value' => 'In hive (storage)', 'checked' => false];
        $code_names=Apiary::get('code_name');
        foreach ($code_names as $var){
            $this->filter_state_dropdown[] = ['name' => 'On '.$var->code_name, 'value' => 'On '.$var->code_name, 'checked' => false];
        }
    }
    public function family_status($family){
        if($family->die_off_date!=null){
            return "Dead";
        }
        if($family->hive==null){
            return "Homeless";
        }
        if($family->hive->apiary_code_name==null){
            return "In hive (storage)";
        }
        return "On ".$family->hive->apiary_code_name;
    }
    public function get_bee_families(){
        $num_pages=10;
        switch($this->filter_state){
            case '':
                return BeeFamily::paginate($num_pages);
            case 'Dead':
                //return BeeFamily::whereNotNull('die_off_date')
                return BeeFamily::onlyTrashed()
                    ->paginate($num_pages);
            case 'Homeless':
                return BeeFamily::where('hive_id',null)
                    ->whereNull('die_off_date')
                    ->paginate($num_pages);
            case 'In hive (storage)':
                return BeeFamily::whereNull('die_off_date')
                    ->whereHas('hive',
                        function($query){
                            $query->where('apiary_code_name',null);
                        })
                    ->paginate($num_pages);
            default:
                //in hive on apiary
                if(strpos($this->filter_state,"On ")==0) {
                    return BeeFamily::whereHas('hive',
                        function ($query) {
                            $query->where('apiary_code_name', substr($this->filter_state, 3));
                        })->paginate($num_pages);
                }
                return [];
        }

    }

    public function render()
    {
        return view(
            'livewire.bee-family.table',
                [
                    'beefamilies'=>$this->get_bee_families()
                ]
        );
    }

    public function openBeeFamilyDeleteModal($id){
        $this->emit('openBeeFamilyDeleteModal', $id);
    }
    public function openBeeFamilyDetailsModal($id){
        $this->emit('openBeeFamilyDetailsModal', $id);
    }
    public function openBeeFamilyEditModal($id){
        $this->emit('openBeeFamilyEditModal', $id);
    }
    public function openBeeFamilyAssignHiveModal($id)    {
        $this->emit('openBeeFamilyAssignHiveModal', $id);
    }
}
