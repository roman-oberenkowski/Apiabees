<x-app-layout>

    <x-slot name="header">
        @include('headers.employees')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            <div class="overflow-hidden sm:rounded-md">
                @livewire('employee.create-form')
            </div>
        </x-section>
    </x-slot>
</x-app-layout>
