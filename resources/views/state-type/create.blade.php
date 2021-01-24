<x-app-layout>
    <x-slot name="header">
        @include('headers.state-types')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('state-type.create')

        </x-section>
    </x-slot>
</x-app-layout>
