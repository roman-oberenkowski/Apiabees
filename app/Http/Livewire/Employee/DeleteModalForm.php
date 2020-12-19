<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        try{
            $employee = Employee::findOrFail($this->PESEL);
            if(isset($employee->user)){
                $employee->user->delete();
            }
            $employee->delete();
            flash("User {$employee->first_name} {$employee->last_name} has been deleted.")->success()->livewire($this);

            $this->closeModal();
        }
        catch(ModelNotFoundException $e){
            flash("Cannot delete chosen user. Please check if user is really in the database and try again")->error()->livewire($this);
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
