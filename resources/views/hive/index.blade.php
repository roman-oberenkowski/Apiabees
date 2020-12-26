<x-app-layout>
    <x-slot name="header">
        @include('headers.actions')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('action.table')

        </x-section>
    </x-slot>
</x-app-layout>
