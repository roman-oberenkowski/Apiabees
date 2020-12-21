<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateForm extends Component
{
    public bool $saved = false;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $PESEL = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $salary = '';
    public string $date_of_employment;
    public string $appartement = '';
    public string $house_number = '';
    public string $street = '';
    public string $city = '';

    function __construct()
    {
        parent::__construct();
        $this->date_of_employment = Carbon::now()->toDateString();
        //dd($this->date_of_employment);
    }

    /**
     * The validation rules
     *
     * @return void
     */
    protected function rules(){
        return Employee::validationRulesCreate();
    }

    /**
     * Validates data online
     *
     * @param $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validated = $this->validate();
        $employee = Employee::create($validated);
        $user = new User;
        $user->email= $this->email;
        $user->password= Hash::make($this->password);
        $user->employee_PESEL = $employee->PESEL;
        $user->name=$this->first_name.' '.$this->last_name;
        $user->save();

        flash("Employee {$employee->first_name} {$employee->last_name} has been created.")->session();
        $this->reset();
        $this->resetValidation();
        $this->emit('newEmployeeCreated');
        $this->saved = true;
        return redirect()->route('employees.index');
    }

    /**
     * Renders component
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.employee.create-form');
    }
}
