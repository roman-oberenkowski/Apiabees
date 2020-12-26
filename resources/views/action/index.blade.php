<x-app-layout>
    <x-slot name="header">
        @include('headers.actions')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('action.table')
            @livewire('action.delete-modal')

        </x-section>
    </x-slot>
</x-app-layout>
