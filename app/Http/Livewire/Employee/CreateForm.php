<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
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

    /**
     * Form constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->date_of_employment = Carbon::now()->toDateString();
    }

    /**
     * The validation rules
     *
     * @return void
     */
    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'min:8'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:employees', 'min:5'],
        'password' => ['required', 'string', 'confirmed', 'min:8'],
        'PESEL' => ['required', 'string', 'size:11', 'unique:employees', 'regex:/^\d{11}?$/'],
        'first_name' => ['required', 'string', 'max:32', 'min:3'],
        'last_name' => ['required', 'string', 'max:32', 'min:3'],
        'salary' => ['required', 'numeric', 'gt:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        'date_of_employment' => ['required', 'date', 'before_or_equal:today'],
        'appartement' => ['nullable', 'string', 'min:1'],
        'house_number' => ['string', 'required', 'min:1'],
        'street' => ['string', 'required', 'min:1'],
        'city' => ['string', 'required', 'min:1'],
    ];

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

    /**
     * Create Employee and User function.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validated = $this->validate();
        $employee = Employee::create($validated);
        $user = User::create($validated);
        $user->employee_PESEL = $employee->PESEL;
        $user->save();

        session()->flash('success', "Employee {$employee->first_name} {$employee->last_name} has been created.");
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
