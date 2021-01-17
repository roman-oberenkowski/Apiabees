<x-app-layout>
    <x-slot name="header">
        @include('headers.task-types')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('task-type.create')

        </x-section>
    </x-slot>
</x-app-layout>
