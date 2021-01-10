<x-app-layout>
    <x-slot name="header">
        @include('headers.apiaries')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('apiary.create')
        </x-section>
    </x-slot>
</x-app-layout>
