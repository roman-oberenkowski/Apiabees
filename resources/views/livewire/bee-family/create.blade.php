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
                                        <x-jet-label for="species_name"  value="Specie:" />
                                        <x-select for="species_name" wire:model="species_name" :options="$species_dropdown"  required/>
                                        <x-jet-input-error for="species_name" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="population" value="{{ __('population') }}" />
                                        <x-jet-input id="population" type="text" class="mt-1 block w-full" wire:model="population" autocomplete="population"  required/>
                                        <x-jet-input-error for="population" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="acquired_at" value="{{ __('acquired  at') }}" />
                                        <x-jet-input id="acquired_at" type="date" class="mt-1 block w-full" wire:model="acquired_at" autocomplete="acquired_at" required/>
                                        <x-jet-input-error for="acquired_at" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="hive_id" value="{{ __('Hive') }}" />
                                        @if($this->hive_id!=null)
                                            Hive chosen
                                        @else
                                            No hive chosen
                                        @endif
                                        <x-jet-input-error for="hive_id" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <x-jet-secondary-button wire:click.prevent="chooseHive" wire:loading.attr="disabled" class="">
                                            {{ __('Choose Hive') }}
                                        </x-jet-secondary-button>
                                        @if($this->hive_id!=null)
                                            <x-jet-secondary-button wire:click.prevent="openHiveDetailsModal" wire:loading.attr="disabled">
                                                {{ __('Hive Details') }}
                                            </x-jet-secondary-button>
                                            <x-jet-secondary-button wire:click.prevent="resetSelectedHive" wire:loading.attr="disabled">
                                                {{ __('Reset Hive selection') }}
                                            </x-jet-secondary-button>
                                        @endif
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
