<x-app-layout>
    <x-slot name="header">
        @include('headers.bee-families')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('bee-family.table')
            @livewire('bee-family.delete-modal')
            @livewire('bee-family.details-modal')
            @livewire('bee-family.assign-hive-modal')
            @livewire('hive.choose-modal')
            @livewire('hive.details-modal')
            @livewire('family-state.index-modal')
            @livewire('family-state.details-modal')



        </x-section>
    </x-slot>
</x-app-layout>
