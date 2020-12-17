<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;

class DeleteModalForm extends Component
{
    public bool $isModalOpen = false;

    public string $PESEL = '';

    /**
     * Components listeners
     *
     **/
    protected $listeners = [
        'openEmployeeDeleteModalForm' => 'openModal',
    ];

    /**
     * The validation rules
     *
     * @return void
     */
    protected $rules = [
        'PESEL' => ['required', 'string', 'size:11', 'unique:employees', 'regex:/^\d{11}?$/'],
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
     * Opens modal
     * @param string $pesel
     *
     * @return void
     */
    public function openModal(string $PESEL)
    {
        $this->resetValidation();
        $this->reset();
        $this->PESEL = $PESEL;
        $this->isModalOpen = true;
    }

    /**
     * Closes modal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->isModalOpen = false;
        $this->emit('closedDeleteModalForm');
    }

    public function destroy()
    {
        $employee = Employee::find($this->PESEL);
        if (!isset($employee))
        {
            session()->flash('error', "Cannot find user with given PESEL.");
            $this->closeModal();
        }
        else
        {
            $employee->delete();
            session()->flash('success', "User {$employee->first_name} {$employee->last_name} has been deleted.");
            $this->closeModal();
        }
    }

    /**
     * Renderd modal
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.employee.delete-modal-form');
    }
}
