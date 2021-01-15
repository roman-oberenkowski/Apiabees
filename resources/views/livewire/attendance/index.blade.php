<div xmlns:wire="http://www.w3.org/1999/xhtml">
        <x-flash />
        <form wire:submit.prevent="store" method="POST">
            @csrf
            <div class="p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-jet-section-title>
                        <x-slot name="title">General information</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="qr_code" value="{{ __('Employee') }}" />
                                        {{$this->employee_PESEL}}
                                        <x-jet-label for="qr_code" value="{{ __('Status') }}" />
                                        {{$this->status}}
                                    </div>
                                    <br />
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-secondary-button wire:click="start" wire:loading.attr="disabled">
                                            {{ __('Mark work start') }}
                                        </x-jet-secondary-button>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-secondary-button wire:click="finish" wire:loading.attr="disabled">
                                            {{ __('Mark work finished') }}
                                        </x-jet-secondary-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-span-12 flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 mt-4 rounded ">
                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </form>
    </div>
