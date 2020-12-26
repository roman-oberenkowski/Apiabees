<?php

namespace App\Http\Livewire\Action;

use App\Models\ActionType;
use App\Models\Employee;
use Livewire\Component;
use App\Models\Action;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public string $filter_description = '';
    public string $filter_employee_PESEL='';
    public string $filter_type_name='';
    public string $filter_date='';
    public $test;
    protected $listeners = [
        'closedActionDeleteModal' => '$refresh',
    ];

    public function mount()
    {
        if(session()->has('actions_selected_employee')){
            $this->filter_employee_PESEL=session()->pull('actions_selected_employee');
        }
        $this->resetPage();
    }

    public function resetFilters(){
        $this->filter_description = '';
        $this->filter_employee_PESEL='';
        $this->filter_type_name='';
        $this->filter_date='';
    }

    public function optionalDateFilter($query)
    {
        if ($this->filter_date) {
            return $query->whereDate('performed_at', $this->filter_date);
        }
        return $query;
    }

    public function render()
    {
        $type_names_temp = ActionType::get('name');
        $type_names_dropdown = [['name' => '', 'value'=>'','checked'=>false]];
        foreach ($type_names_temp as $type) {
            $type_names_dropdown[] = ['name' => $type->name, 'value' => $type->name, 'checked' => false];
        }
        $employee_temp = Employee::orderBy('last_name')->get(['PESEL', 'first_name', 'last_name']);
        $employee_dropdown = [['name'=>'', 'value'=> '', 'checked'=>false]];

        foreach ($employee_temp as $emp) {
            $employee_dropdown[] = ['name' => $emp->first_name . ' ' . $emp->last_name, 'value' => $emp->PESEL, 'checked' => false];
        }

        return view(
            'livewire.action.table',
                [
                'actions' => Action::where('employee_PESEL', 'like', "%{$this->filter_employee_PESEL}%")
                    ->where('type_name', 'like', "%{$this->filter_type_name}%")
                    ->where('description', 'like', "%{$this->filter_description}%")
                    ->when($this->filter_date, function($query,$date){
                        return $query->whereDate('performed_at', $date);
                    })
                    ->orderBy('performed_at', 'desc')->paginate(5),
                'filter_employees_dropdown' => $employee_dropdown,
                'filter_type_names_dropdown' => $type_names_dropdown,
                ]
        );

    }

    public function formatDescription($in){
        if(strlen($in)>32)
            return substr($in,0,29).'...';
        return $in;
    }

    public function openActionDeleteModal($id){
        $this->emit('openActionDeleteModal', $id);
    }
}
