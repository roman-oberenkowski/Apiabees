<x-app-layout>
    <x-slot name="header">
        @include('headers.task-types')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('task-type.table')
            @livewire('task-type.delete-modal')
        </x-section>
    </x-slot>
</x-app-layout>
