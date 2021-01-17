<x-app-layout>
    <x-slot name="header">
        @include('headers.species')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('specie.table')
            @livewire('specie.delete-modal')
        </x-section>
    </x-slot>
</x-app-layout>
