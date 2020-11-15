<x-app-layout>

    <x-slot name="header">
        @include('headers.example')
    </x-slot>

    <x-slot name="slot">
        <x-section>
            @livewire('example.table')
        </x-section>
        <x-section>
            <div class="p-6">
                @livewire('example.form-short')
            </div>
        </x-section>
        <x-section>
            <div class="p-6">
                @livewire('example.form')
            </div>
        </x-section>
    </x-slot>
</x-app-layout>
