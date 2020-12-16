<x-app-layout>
    <x-slot name="header">
        @include('headers.employees')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('employee.table')
        </x-section>
    </x-slot>
</x-app-layout>
