<x-app-layout>
    <x-slot name="header">
        @include('headers.task-assignments')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('task-assignment.create')

        </x-section>
    </x-slot>
</x-app-layout>
