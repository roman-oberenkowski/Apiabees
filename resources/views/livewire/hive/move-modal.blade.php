<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Move hive') }}
        </x-slot>

        <x-slot name="content">
            <div class="p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-jet-section-title>
                        <x-slot name="title">Current hive position</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="old_apiary_code_name" value="{{ __('Apiary') }}" />
                                        {{$this->old_apiary_code_name}}
                                    </div>

                                    <div class="col-span-6">
                                        <x-jet-label for="password" value="{{ __('Row') }}" />
                                        {{$this->old_location_row}}
                                    </div>

                                    <div class="col-span-6">
                                        <x-jet-label for="password" value="{{ __('Column') }}" />
                                        {{$this->old_location_column}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-jet-section-title>
                        <x-slot name="title">Target hive position</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="new_apiary_code_name" value="Apiary" />
                                        <x-select for="apiary_code_name" wire:model="apiary_code_name" :options="$apiary_code_name_dropdown"  />
                                        <x-jet-input-error for="apiary_code_name" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3"></div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="location_row" value="{{ __('Row') }}" />
                                        <x-jet-input id="location_row" type="text" class="mt-1 block w-full" wire:model="location_row" autocomplete="location_row"  />
                                        <x-jet-input-error for="location_row" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="location_column" value="{{ __('Column') }}" />
                                        <x-jet-input id="location_column" type="text" class="mt-1 block w-full" wire:model="location_column" autocomplete="location_column"  />
                                        <x-jet-input-error for="location_column" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="choose" wire:loading.attr="disabled">
                {{ __('Confirm') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
