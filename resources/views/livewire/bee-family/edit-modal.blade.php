<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Edit apiary') }}
        </x-slot>

        <x-slot name="content">
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
                                        <x-jet-label for="hive_id" value="{{ __('hive_id') }}" />
                                        <x-jet-input id="hive_id" type="text" class="mt-1 block w-full" wire:model="hive_id" autocomplete="hive_id" />
                                        <x-jet-input-error for="hive_id" class="mt-2" />
                                        <x-jet-button wire:click.prevent="chooseHive" wire:loading.attr="disabled">
                                            {{ __('Choose Hive') }}
                                        </x-jet-button>
                                        <div class="col-span-6 sm:col-span-3">
                                            <x-jet-label value="{{ __('Choosen Hive info') }}" />
                                            {{$choosen_hive_info}}
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="col-span-12 flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 mt-4 rounded ">
                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled" class="pm-3">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button wire:click="update">
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
