<x-app-layout>
    <x-slot name="header">
        @include('headers.hives')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('hive.create')
        </x-section>
    </x-slot>
</x-app-layout>
