<x-app-layout>
    <x-slot name="header">
        @include('headers.hives')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('hive.table')
            @livewire('hive.move-modal')
            @livewire('hive.delete-modal')
            @livewire('hive.details-modal')

            @livewire('bee-family.details-modal')
            @livewire('family-state.details-modal')
        </x-section>
    </x-slot>
</x-app-layout>
