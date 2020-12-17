<x-app-layout>
    <x-slot name="header">
        @include('headers.action_types')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('action-type.table')

        </x-section>
    </x-slot>
</x-app-layout>
