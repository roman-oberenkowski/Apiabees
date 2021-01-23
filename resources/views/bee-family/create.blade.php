<x-app-layout>
    <x-slot name="header">
        @include('headers.bee-families')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('bee-family.create')
            @livewire('hive.choose-modal')
            @livewire('hive.details-modal')
            @livewire('bee-family.details-modal')
            @livewire('family-state.details-modal')
        </x-section>
    </x-slot>
</x-app-layout>
