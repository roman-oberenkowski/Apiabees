<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class EditModalForm extends Component
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
    public string $date_of_employment;

    /**
     * Form constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->date_of_employment = Carbon::now()->toDateString();
    }
    /**
     * Components listeners
     *
     **/
    protected $listeners = [
        'openEmployeeEditModalForm' => 'openModal',
    ];

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
     * Update Employee and User function.
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        $data = $this->modelData();
        $employee = Employee::find($this->PESEL)->update($data);
        $employee->user()->createOrUpdate($data);
        session()->flash('success', "Employee successsfully updated.");
        $this->closeModal();
    }

    /**
     * Opens modal
     * @param Employee $employee
     *
     * @return void
     */
    public function openModal(Employee $employee)
    {
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = true;
        $this->loadData($employee);

    }

    /**
     * Loads the model data
     * of this component.
     *
     * @param Employee $employee
     * @return void
     */
    public function loadData(Employee $employee)
    {
        if(isset($employee->user))
        {
            $this->name = $employee->user->name;
            $this->password = $employee->user->password;
            $this->password_confirmation = $employee->user->password;
        }
        else
        {
            $this->name = '';
            $this->password = '';
            $this->password_confirmation = '';
        }
        $this->PESEL = $employee->PESEL;
        $this->email = $employee->email;
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->salary = $employee->salary;
        $this->date_of_employment = $employee->date_of_employment;
        $this->appartement = $employee->appartement;
        $this->house_number = $employee->house_number;
        $this->street = $employee->street;
        $this->city = $employee->city;
    }

    /**
     * The data for the model mapped to component
     *
     * @return array
     */
    public function modelData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'salary' => $this->salary,
            'date_of_employment' => $this->date_of_employment,
            'appartement' => $this->appartement,
            'house_number' => $this->house_number,
            'street' => $this->street,
            'city' => $this->city,
        ];
    }

    /**
     * Closes modal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = false;
        $this->emit('closedEditModalForm');
    }

    /**
     * Renders component
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.employee.edit-modal-form');
    }
}
