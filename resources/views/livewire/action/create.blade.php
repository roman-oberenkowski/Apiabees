<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <x-flash />

    <form wire:submit.prevent="store" method="POST">
        @csrf
        <div class="p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="mt-5 md:mt-0 md:col-span-3">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="employee_PESEL" value="Choose yourself:" />
                                    <x-select for="employee_PESEL" wire:model="employee_PESEL" :options="$employees_dropdown"  />
                                    <x-jet-input-error for="employee_PESEL" class="mt-2" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="type_name"  value="Choose action type:" />
                                    <x-select for="type_name" wire:model="type_name" :options="$type_names_dropdown"  />
                                    <x-jet-input-error for="type_name" class="mt-2" />
                                </div>

                                <div class="col-span-6">
                                    <x-jet-label for="description" value="Action description" />
                                    <x-text-area for="description" wire:model="description" placeholder="Please provide action description if needed" rows="3"></x-text-area>
                                    <x-jet-input-error for="description" class="mt-2" />
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
                                <x-jet-button wire:click.prevent="chooseHive" wire:loading.attr="disabled">
                                    {{ __('Choose Hive') }}
                                </x-jet-button>
                                @if($this->hive_id!=null)
                                <x-jet-button wire:click.prevent="openHiveDetailsModal" wire:loading.attr="disabled">
                                    {{ __('Hive Details') }}
                                </x-jet-button>
                                <x-jet-button wire:click.prevent="resetSelectedHive" wire:loading.attr="disabled">
                                    {{ __('Reset Hive selection') }}
                                </x-jet-button>
                                @endif

                                @if($type_name==\App\Models\ActionType::special_action_inspection)
                                    REST OF THE FORM FOR INSP
                                @endif




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
