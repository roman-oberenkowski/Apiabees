<x-app-layout>
    <x-slot name="header">
        @include('headers.employees')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('employee.table')
            @livewire('employee.edit-modal-form')
            @livewire('employee.delete-modal-form')
            @livewire('employee.details-modal')
            @livewire('action.details-modal')
            @livewire('hive.details-modal')
            @livewire('bee-family.details-modal')
            @livewire('family-state.details-modal')
        </x-section>
    </x-slot>
</x-app-layout>
