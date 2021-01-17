<x-app-layout>
    <x-slot name="header">
        @include('headers.honey-types')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('honey-type.table')
            @livewire('honey-type.delete-modal')
        </x-section>
    </x-slot>
</x-app-layout>
