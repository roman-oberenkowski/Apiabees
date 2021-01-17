<?php

namespace App\Http\Livewire\TaskAssignment;

use App\Models\Apiary;
use App\Models\Employee;
use App\Models\TaskAssignment;
use App\Models\TaskType;
use Livewire\Component;

class Create extends Component
{
    protected $listeners=[];

    public string $apiary_code_name='';
    public array $apiary_code_name_dropdown=[];

    public string $employee_PESEL='';
    public array $employee_PESEL_dropdown=[];

    public string $task_type_name='';
    public array $task_type_name_dropdown=[];


    protected function rules()
    {
        return TaskAssignment::validationRulesCreate();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function setup_dropdowns(){
        $this->apiary_code_name_dropdown=[];
        $apiaries=Apiary::get(['code_name']);
        $this->apiary_code_name_dropdown[] = ['name' => '', 'value' => '', 'checked' => false];
        foreach ($apiaries as $apiary) {
            $this->apiary_code_name_dropdown[] = ['name' => $apiary->code_name, 'value' => $apiary->code_name, 'checked' => false];
        }
        $this->employee_PESEL_dropdown=[];
        $emps=Employee::get(['first_name','last_name','PESEL']);
        $this->employee_PESEL_dropdown[]=['name' => '', 'value' => '', 'checked' => false];
        foreach($emps as $emp){
            $this->employee_PESEL_dropdown[]=['name' => $emp->first_name.' '.$emp->last_name, 'value' => $emp->PESEL, 'checked' => false];
        }

        $this->task_type_name_dropdown=[];
        $task_types=TaskType::get(['name']);
        $this->task_type_name_dropdown[] = ['name' => '', 'value' => '', 'checked' => false];
        foreach ($task_types as $tt) {
            $this->task_type_name_dropdown[] = ['name' => $tt->name, 'value' => $tt->name, 'checked' => false];
        }

    }

    public function store()
    {
            $validated=$this->validate();
            $ta=TaskAssignment::where('task_type_name',$this->task_type_name)
                ->where('employee_PESEL',$this->employee_PESEL)
                ->where('apiary_code_name',$this->apiary_code_name)
                ->first();
            if($ta!=null){
                $this->addError('apiary_code_name','That task assignment already exists!');
                return;
            }
            $task_assignment=new TaskAssignment($validated);
            $task_assignment->save();

            $this->afterStore();
    }

    public function afterStore()
    {
        flash("Task has been assigned.")->success()->session();
        $this->reset();
        $this->resetValidation();
        $this->emit('newTaskAssignmentCreated');
        return redirect()->route('task-assignments.index');
    }

    public function mount(){
        $this->setup_dropdowns();
    }

    public function render()
    {
        return view('livewire.task-assignment.create', [

        ]);
    }
}
