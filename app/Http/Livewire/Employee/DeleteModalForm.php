<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class DeleteModalForm extends Component
{
    public bool $isModalOpen = false;

    public string $PESEL = '';

    protected $listeners = [
        'openEmployeeDeleteModalForm' => 'openModal',
    ];


    public function openModal(string $PESEL)
    {
        $this->resetValidation();
        $this->reset();
        $this->PESEL = $PESEL;
        try{
            $employee = Employee::findOrFail($this->PESEL);
        }
        catch(ModelNotFoundException $e){
            flash("Cannot delete chosen user. Please check if user is really in the database and try again")->error()->livewire($this);
            $this->closeModal();
        }
        $this->isModalOpen = true;
    }


    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->isModalOpen = false;
        $this->emit('closedDeleteModalForm');
    }

    public function destroy()
    {
        try{
            $employee = Employee::findOrFail($this->PESEL);
            if(isset($employee->user)){
                $employee->user->delete();
            }
            $employee->delete();
            flash("Employee {$employee->first_name} {$employee->last_name} has been deleted.")->success()->livewire($this);

            $this->closeModal();
        }
        catch(ModelNotFoundException $e){
            flash("Cannot delete chosen user. Please check if user is really in the database and try again")->error()->livewire($this);
            $this->closeModal();
        }
    }


    public function render()
    {
        return view('livewire.employee.delete-modal-form');
    }
}
