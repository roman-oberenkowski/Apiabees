<?php

namespace App\Http\Livewire\Employee;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class CreateForm extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $PESEL;
    public $first_name;
    public $last_name;
    public $salary;
    public $date_of_employment;
    public $appartement;
    public $house_number;
    public $street;
    public $city;

    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'min:8'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:employees', 'min:5'],
        'password' => ['required', 'string', 'password', 'confirmed', 'min:8'],
        'PESEL' => ['required', 'string', 'size:11', 'unique:employees'],
        'first_name' => ['required', 'string', 'max:32', 'min:3'],
        'last_name' => ['required', 'string', 'max:32', 'min:3'],
        'salary' => ['required', 'numeric', 'gt:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        'date_of_employment' => ['required', 'date', 'before_or_equal:today'],
        'appartement' => ['nullable', 'string', 'min:1'],
        'house_number' => ['string', 'required', 'min:1'],
        'street' => ['string', 'required', 'min:1'],
        'city' => ['string', 'required', 'min:1'],
    ];

    public function render()
    {
        return view('livewire.employee.create-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $validated = $this->validate();

        $employee = Employee::create($validated);
        $user = User::create($validated);
        $user->employee_PESEL = $employee->PESEL;
        $user->save();

        session()->flash('success', "Employee {$employee->first_name} {$employee->last_name} has been created.");
        return
            redirect()
            ->route('employees.index');

    }
}
