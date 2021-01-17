<?php

namespace App\Http\Livewire\TaskAssignment;

use App\Models\ActionType;
use App\Models\Apiary;
use App\Models\Employee;
use App\Models\TaskAssignment;
use App\Models\TaskType;
use Livewire\Component;
use App\Models\Action;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public string $filter_employee_PESEL = '';
    public array $filter_employee_PESEL_dropdown = [];
    public string $filter_task_type_name = '';
    public array $filter_task_type_name_dropdown = [];
    public string $filter_apiary_code_name = '';
    public array $filter_apiary_code_name_dropdown = [];
    public string $filter_date = '';


    protected $listeners = [
        'closedTaskAssignmentDeleteModal' => '$refresh',
    ];

    public function mount()
    {
        if (session()->has('actions_selected_employee')) {
            $this->filter_employee_PESEL = session()->pull('actions_selected_employee');
        }
        $this->resetPage();
        $this->setup_dropdowns();
    }

    public function setup_dropdowns()
    {
        $this->filter_apiary_code_name_dropdown = [];
        $apiaries = Apiary::get(['code_name']);
        $this->filter_apiary_code_name_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        foreach ($apiaries as $apiary) {
            $this->filter_apiary_code_name_dropdown[] = ['name' => $apiary->code_name, 'value' => $apiary->code_name, 'checked' => false];
        }
        $this->filter_employee_PESEL_dropdown = [];
        $emps = Employee::get(['first_name', 'last_name', 'PESEL']);
        $this->filter_employee_PESEL_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        foreach ($emps as $emp) {
            $this->filter_employee_PESEL_dropdown[] = ['name' => $emp->first_name . ' ' . $emp->last_name, 'value' => $emp->PESEL, 'checked' => false];
        }

        $this->filter_task_type_name_dropdown = [];
        $task_types = TaskType::get(['name']);
        $this->filter_task_type_name_dropdown[] = ['name' => 'All', 'value' => '', 'checked' => false];
        foreach ($task_types as $tt) {
            $this->filter_task_type_name_dropdown[] = ['name' => $tt->name, 'value' => $tt->name, 'checked' => false];
        }
    }

    public function resetFilters()
    {
        $this->filter_description = '';
        $this->filter_employee_PESEL = '';
        $this->filter_task_type_name = '';
        $this->filter_date = '';
    }

    public function render()
    {

        return view(
            'livewire.task-assignment.table',
            [
                'task_assignments' => TaskAssignment::where('employee_PESEL', 'like', "%{$this->filter_employee_PESEL}%")
                    ->where('task_type_name', 'like', "%{$this->filter_task_type_name}%")
                    ->where('apiary_code_name', 'like', "%{$this->filter_apiary_code_name}%")
                    ->when($this->filter_date, function ($query, $date) {
                        return $query->whereDate('assignment_date', $date);
                    })
                    ->orderBy('assignment_date', 'desc')->paginate(10),
                'filter_employee_PESEL_dropdown' => $this->filter_employee_PESEL_dropdown,
                'filter_task_type_name_dropdown' => $this->filter_task_type_name_dropdown,
                'filter_apiary_code_name_dropdown' => $this->filter_apiary_code_name_dropdown
            ]
        );

    }


    public function openTaskAssignmentDeleteModal($id)
    {
        $this->emit('openTaskAssignmentDeleteModal', $id);
    }

}
