<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
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


    protected $listeners = [
        'openEmployeeDetailsModal' => 'openModal',
    ];

    public function openModal(Employee $employee)
    {
        $this->loadData($employee);
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->emit('closedEmployeeDetailsModalForm');
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
}
