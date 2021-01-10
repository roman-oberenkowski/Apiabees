<x-app-layout>
    <x-slot name="header">
        @include('headers.apiaries')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('apiary.table')
            @livewire('apiary.delete-modal')
            @livewire('apiary.details-modal')
            @livewire('apiary.edit-modal')
        </x-section>
    </x-slot>
</x-app-layout>
