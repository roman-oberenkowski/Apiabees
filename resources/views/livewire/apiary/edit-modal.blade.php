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
                                        <x-jet-label for="code_name" value="{{ __('Code name') }}" />
                                        <x-jet-input id="code_name" type="text" class="mt-1 block w-full" wire:model="code_name" autocomplete="code_name"  required/>
                                        <x-jet-input-error for="code_name" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name" autocomplete="name"  required/>
                                        <x-jet-input-error for="name" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="area" value="{{ __('Area') }}" />
                                        <x-jet-input id="area" type="text" class="mt-1 block w-full" wire:model="area" autocomplete="area"  required/>
                                        <x-jet-input-error for="area" class="mt-2" />
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
                        <x-slot name="title">Location</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="city" value="{{ __('City') }}" />
                                        <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model="city" autocomplete="city" required/>
                                        <x-jet-input-error for="city" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="street" value="{{ __('Street') }}" />
                                        <x-jet-input id="street" type="text" class="mt-1 block w-full" wire:model="street" autocomplete="street" required/>
                                        <x-jet-input-error for="street" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="parcel" value="{{ __('Parcel') }}" />
                                        <x-jet-input id="parcel" type="text" class="mt-1 block w-full" wire:model="parcel" autocomplete="parcel"  required/>
                                        <x-jet-input-error for="parcel" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="latitude" value="{{ __('Latitude') }}" />
                                        <x-jet-input id="latitude" type="text" class="mt-1 block w-full" wire:model="latitude" autocomplete="latitude"/>
                                        <x-jet-input-error for="latitude" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="longitude" value="{{ __('Longitude') }}" />
                                        <x-jet-input id="longitude" type="text" class="mt-1 block w-full" wire:model="longitude" autocomplete="longitude"/>
                                        <x-jet-input-error for="longitude" class="mt-2" />
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
                        <x-slot name="title">Hives</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="row_num" value="{{ __('Number of rows') }}" />
                                        <x-jet-input id="row_num" type="text" class="mt-1 block w-full" wire:model="row_num" autocomplete="row_num"  required/>
                                        <x-jet-input-error for="row_num" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="col_num" value="{{ __('Number of columns') }}" />
                                        <x-jet-input id="col_num" type="text" class="mt-1 block w-full" wire:model="col_num" autocomplete="col_num"  required/>
                                        <x-jet-input-error for="col_num" class="mt-2" />
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
