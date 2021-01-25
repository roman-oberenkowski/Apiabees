<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Edit Employee') }}
        </x-slot>

        <x-slot name="content">
            <div class="p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-jet-section-title>
                        <x-slot name="title">Authorisation data</x-slot>
                        <x-slot name="description">Data needed for authorisation</x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="email" autocomplete="email" maxlength="255" minlength="5" required/>
                                        <x-jet-input-error for="email" class="mt-2" />
                                    </div>

                                    <div class="col-span-6">
                                        <x-jet-label for="password" value="{{ __('Change Password (optional)') }}" />
                                        <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model="password" autocomplete="password" minlength="8" required/>
                                        <x-jet-input-error for="password" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="password_confirmation" value="{{ __('Confirm password (optional) ') }}" />
                                        <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="password_confirmation" autocomplete="password_confirmation" minlength="8" required/>
                                        <x-jet-input-error for="password_confirmation" class="mt-2" />
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
                        <x-slot name="title">Personal informations</x-slot>
                        <x-slot name="description">Personal details informations</x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    <div class="col-span-6 ">
                                        <x-jet-label for="first_name" value="{{ __('First name') }}" />
                                        <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model="first_name" autocomplete="first_name" maxlength="32" minlength="3" required/>
                                        <x-jet-input-error for="first_name" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="last_name" value="{{ __('Last name') }}" />
                                        <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model="last_name" autocomplete="last_name" maxlength="32" minlength="3" required/>
                                        <x-jet-input-error for="last_name" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="salary" value="{{ __('Salary [zł]') }}" />
                                        <x-jet-input id="salary" type="text" class="mt-1 block w-full" wire:model="salary" autocomplete="salary"/>
                                        <x-jet-input-error for="salary" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="date_of_employment" value="{{ __('Date of employment (optional)') }}" />
                                        <x-jet-input id="date_of_employment" type="date" class="mt-1 block w-full" wire:model="date_of_employment" autocomplete="date_of_employment"/>
                                        <x-jet-input-error for="date_of_employment" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="appartement" value="{{ __('Appartement') }}" />
                                        <x-jet-input id="appartement" type="text" class="mt-1 block w-full" wire:model="appartement" autocomplete="appartement" required/>
                                        <x-jet-input-error for="appartement" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="house_number" value="{{ __('House number') }}" />
                                        <x-jet-input id="house_number" type="text" class="mt-1 block w-full" wire:model="house_number" autocomplete="house_number" required/>
                                        <x-jet-input-error for="house_number" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="street" value="{{ __('Street') }}" />
                                        <x-jet-input id="street" type="text" class="mt-1 block w-full" wire:model="street" autocomplete="street" required/>
                                        <x-jet-input-error for="street" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="city" value="{{ __('City') }}" />
                                        <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model="city" autocomplete="city" required/>
                                        <x-jet-input-error for="city" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="col-span-12 flex items-center justify-end px-4 py-3 text-right sm:px-6 rounded ">
                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled" class="mr-3">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button wire:click="update">
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
