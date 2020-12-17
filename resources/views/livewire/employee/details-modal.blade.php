<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __("Details of $first_name $last_name") }}
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
                                        <x-jet-label for="name" value="{{ __('Username') }}" />
                                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name" autocomplete="name" maxlength="255" minlength="8" required/>
                                        <x-jet-input-error for="name" class="mt-2" />
                                    </div>

                                    <div class="col-span-6">
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model="password" autocomplete="password" minlength="8" required/>
                                        <x-jet-input-error for="password" class="mt-2" />
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="password_confirmation" value="{{ __('Confirm password') }}" />
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
                                        <x-jet-label for="salary" value="{{ __('Salary') }}" />
                                        {{$salary}}
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label value="{{ __('Date of employment') }}" />
                                        {{   \Carbon\Carbon::parse($date_of_employment)->format('d/m/Y')   }}
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="appartement" value="{{ __('Appartement') }}" />
                                        {{$appartement}}
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="house_number" value="{{ __('House number') }}" />
                                        {{$house_number}}
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="street" value="{{ __('Street') }}" />
                                        {{$street}}
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="city" value="{{ __('City') }}" />
                                        {{$city}}
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
                {{ __('Close') }}
            </x-jet-secondary-button>
            <x-jet-button wire:click="openEditModalForm" wire:loading.attr="disabled">
                {{ __('Edit') }}
            </x-jet-button>



        </x-slot>
    </x-jet-dialog-modal>
</div>
