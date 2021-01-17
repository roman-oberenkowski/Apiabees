<x-app-layout>
    <x-slot name="header">
        @include('headers.task-assignments')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('task-assignment.table')
            @livewire('task-assignment.delete-modal')

        </x-section>
    </x-slot>
</x-app-layout>
