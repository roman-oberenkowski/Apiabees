<x-app-layout>
    <x-slot name="header">
        @include('headers.state-types')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('state-type.table')
            @livewire('state-type.delete-modal')
        </x-section>
    </x-slot>
</x-app-layout>
