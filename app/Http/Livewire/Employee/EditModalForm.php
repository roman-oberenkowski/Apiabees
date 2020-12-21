<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditModalForm extends Component
{
    public bool $isModalOpen = false;

    public $user_id = NULL;
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


    protected $listeners = [
        'openEmployeeEditModalForm' => 'openModal',
    ];

    protected function rules()
    {
        $emprules = Employee::validationRulesUpdate();
        if (isset($this->user_id)) {
            $emprules['email'] = ['required', 'string', 'email', 'min:5', 'max:255', Rule::unique('users')->ignore($this->user_id)];
        } else
            $emprules['email'] = ['required', 'string', 'email', 'min:5', 'max:255', 'unique:users'];
        return $emprules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();
        $data = $this->modelData();
        try {
            $employee = Employee::findOrFail($this->PESEL);
            $employee->update($data);
            $user = User::where('employee_PESEL', $employee->PESEL)->first();
            if ($user == NULL) {
                if (strlen($data['password']) == 0) {
                    //no user for that employee, but no password provided
                    $this->addError('password', 'That employee doesn\'t have an account yet, so you need to provide a password.');
                    return;
                }
                //create user
                $userData = [];
                $userData['name'] = $employee->first_name . ' ' . $employee->last_name;
                $userData['email'] = $data['email'];
                $userData['password'] = Hash::make($data['password']);
                $userData['employee_Pesel'] = $this->PESEL;
                $employee->user()->Create($userData);
            } else {
                $user->name = $employee->first_name . ' ' . $employee->last_name;
                $user->email = $data['email'];
                if (strlen($data['password']) > 0) {

                    $user->password = Hash::make($data['password']);
                    flash("Employee password changed.")->info()->livewire($this);
                }
                $user->save();
            }

            flash("Employee successsfully updated.")->success()->livewire($this);
            $this->closeModal();
        } //catching for example concurrent start edit, other user deletes and first try to save
        catch (ModelNotFoundException $e) {
            flash("Cannot edit chosen user. Please check if user is still in the database and try again")->error()->livewire($this);
            $this->closeModal();
        }

    }

    public function openModal(Employee $employee)
    {
        $this->resetValidation();
        $this->reset();
        $this->loadData($employee);
        $this->isModalOpen = true;
    }

    public function loadData(Employee $employee)
    {
        if (isset($employee->user)) {
            $this->name = $employee->user->name;
            //$this->password = $employee->user->password;
            //$this->password_confirmation = $employee->user->password;
            $this->email = $employee->user->email;
            $this->user_id = $employee->user->id;
        } else {

            $this->name = '';
            $this->password = '';
            $this->password_confirmation = '';
        }
        $this->PESEL = $employee->PESEL;
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->salary = $employee->salary;
        $this->date_of_employment = Carbon::parse($employee->date_of_employment)->format('Y-m-d');

        $this->appartement = $employee->appartement;
        $this->house_number = $employee->house_number;
        $this->street = $employee->street;
        $this->city = $employee->city;
    }

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

    public function closeModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->isModalOpen = false;
        $this->emit('closedEditModalForm');
    }

    public function render()
    {
        return view('livewire.employee.edit-modal-form');
    }
}
