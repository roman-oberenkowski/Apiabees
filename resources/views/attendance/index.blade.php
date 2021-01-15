<x-app-layout>
    <x-slot name="header">
        @include('headers.attendances')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('attendance.index')
        </x-section>
    </x-slot>
</x-app-layout>
