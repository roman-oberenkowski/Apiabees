<x-app-layout>
    <x-slot name="header">
        @include('headers.bee-families')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('bee-family.create')
            @livewire('hive.choose-modal')
        </x-section>
    </x-slot>
</x-app-layout>
