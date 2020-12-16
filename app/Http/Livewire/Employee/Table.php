<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    private $employees;

    private $selectedEmployee;

    public bool $isDeleteModalOpen = false;

    public bool $isEditModalOpen = false;

    public bool $isDetailModalOpen = false;

    public string $search__first_name = '';

    public string $search__last_name = '';

    public function render()
    {
        $this->employees = Employee::where('first_name', 'like', "%{$this->search__first_name}%")
            ->where('last_name', 'like', "%{$this->search__last_name}%")
            ->paginate(20);

        return view('livewire.employee.table', [
            'employees' => $this->employees,
            'selectedEmployee' => $this->selectedEmployee
        ]);
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
        } catch (\Exception $e) {
            session()->flash('error', "Cannot find user with given PESEL.");

            return \App::make('redirect')
            ->back();
        }
        session()->flash('success', "User {$employee->first_name} {$employee->last_name} has been deleted.");

        return \App::make('redirect')
            ->back();
    }

    public function openDetailsModal($id) {
        $this->selectedEmployee = Employee::findOrFail($id);
        $this->isDetailModalOpen = true;
    }

    public function openEditModal($id) {
        $this->selectedEmployee = Employee::findOrFail($id);
        $this->isEditModalOpen = true;
    }

    public function openDeleteModal($id) {
        $this->selectedEmployee = Employee::findOrFail($id);
        $this->isDeleteModalOpen = true;
    }

}
