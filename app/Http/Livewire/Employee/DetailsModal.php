<?php

namespace App\Http\Livewire\Employee;

use App\Models\Action;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DetailsModal extends Component
{
    public bool $isModalOpen = false;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $PESEL = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $salary = '';
    public $appartement = '';
    public string $house_number = '';
    public string $street = '';
    public string $city = '';
    public string $date_of_employment = '';
    public array $actions = [];
    public array $attendances =[];


    protected $listeners = [
        'openEmployeeDetailsModal' => 'openModal',
    ];

    public function formatDescription($in){
        if(strlen($in)>32)
            return substr($in,0,29).'...';
        return $in;
    }

    public function openModal($id)
    {
        try{
            $employee=Employee::findOrFail($id);
            $this->loadData($employee);
            $this->actions=Action::
            where('employee_PESEL',$this->PESEL)->
            orderBy('performed_at', 'desc')->
            take(5)->
            get()->
            toArray();
            if(sizeof($this->actions)==0){
                $this->actions[]=['id'=>'','hive_id'=>null,'performed_at'=>"No data yet",'type_name'=>"No data yet",'description'=>"No data yet"];
            }
            $this->attendances=Attendance::
            where('employee_PESEL',$this->PESEL)->
            orderBy('started_at', 'desc')->
            take(3)->
            get(['started_at','finished_at'])->
            toArray();
            if(sizeof($this->attendances)==0){
                $this->attendances[]=['started_at'=>"No data yet",'finished_at'=>"No data yet"];
            }
            $this->isModalOpen = true;
        }
        catch(ModelNotFoundException $e){
            flash("Couldn't find that employee.")->error()->livewire($this);
        }
    }


    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedEmployeeDetailsModalForm');
    }

    public function redirectEmployeeActionsIndex()
    {
        session(['actions_selected_employee'=>$this->PESEL]);
        return redirect()->route('actions.index');
    }

    public function openEditModalForm()
    {
        $id = $this->PESEL;
        $this->closeModal();
        $this->emit('openEmployeeEditModalForm', $id);
    }

    public function loadData(Employee $employee)
    {
        if(isset($employee->user))
        {
            $this->name = $employee->user->name;
            $this->password = $employee->user->password;
            $this->password_confirmation = $employee->user->password;
            $this->email = $employee->user->email;
        }
        else
        {
            $this->name = '';
            $this->password = '';
            $this->password_confirmation = '';
        }
        $this->PESEL = $employee->PESEL;

        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->salary = $employee->salary;
        $this->date_of_employment = $employee->date_of_employment;

        if (strlen($employee->appartement)==0) {
            $this->appartement = 'Brak';
        }
        else{
            $this->appartement = $employee->appartement;
        }


        $this->house_number = $employee->house_number;
        $this->street = $employee->street;
        $this->city = $employee->city;
    }
    public function render()
    {

        return view('livewire.employee.details-modal');
    }
    public function openActionDetailsModal($id){
        $this->emit('openActionDetailsModal', $id);
    }
}
