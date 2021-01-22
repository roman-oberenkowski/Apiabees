<x-app-layout>
    <x-slot name="header">
        @include('headers.scanner')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('scanner.scan')
        </x-section>
    </x-slot>
</x-app-layout>
