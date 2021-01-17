<x-app-layout>
    <x-slot name="header">
        @include('headers.species')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('specie.create')

        </x-section>
    </x-slot>
</x-app-layout>
