<x-app-layout>
    <x-slot name="header">
        @include('headers.productions')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('production.create')

        </x-section>
    </x-slot>
</x-app-layout>
