<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __("Details") }}
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
                                    <div class="col-span-6">
                                        <x-jet-label for="code_name" value="{{ __('Acquired at') }}"/>
                                        {{$this->acquired_at}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="area" value="{{ __('Specie') }}"/>
                                        {{$this->species_name}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="name" value="{{ __('Population') }}"/>
                                        {{$this->population}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="area" value="{{ __('Die off date') }}"/>
                                        {{$this->die_off_date}}
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
                        <x-slot name="title">Hive</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6">
                                    @if($this->hive_id==null)

                                        <div class="col-span-6 ">
                                            <x-jet-label for="Longitude" value="{{ __('Hive') }}"/>
                                            None
                                        </div>
                                    @else
                                        <div class="col-span-6 ">
                                            <x-jet-label for="Longitude" value="{{ __('Hive id') }}"/>
                                            {{$this->hive_id}}
                                        </div>
                                        <div class="col-span-6 ">
                                            <x-jet-label for="Longitude" value="{{ __('Hive on apiary') }}"/>
                                            {{$this->hive_apiary_code_name}}
                                        </div>

                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-jet-section-title>
                        <x-slot name="title">Latest states</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                </div>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Checked at
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        State type
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Inspection description
                    </th>

                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($latest_states as $state)
                    <div>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$state['checked_at']}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$state['state_type_name']}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$this->formatDescription($state['inspection_description'])}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                @if($state['id']!=null)
                                    <a href="#" class="text-red-600 hover:text-red-900"
                                       wire:click="openFamilyStateDetailsModal('{{$state['id']}}')"
                                       wire:loading.attr="disabled"><i class="fas fa-times pr-2"></i>Details</a>
                                @endif
                            </td>
                        </tr>
                    </div>
                @endforeach
                </tbody>
            </table>


        </x-slot>

        <x-slot name="footer">

            @if($this->extended)
                @if($this->die_off_date==$this->alive_text)
                    <x-jet-secondary-button wire:click="openBeeFamilyAssignHiveModal" wire:loading.attr="disabled">
                        {{ __('Assign hive') }}
                    </x-jet-secondary-button>
                @endif
                <x-jet-secondary-button wire:click="openFamilyStateIndexModal" wire:loading.attr="disabled">
                    {{ __('All family states') }}
                </x-jet-secondary-button>
            @endif
            @if($this->hive_id!=null)

                    <x-jet-secondary-button wire:click="openHiveDetailsModal" wire:loading.attr="disabled">
                        {{ __('Hive details') }}
                    </x-jet-secondary-button>

            @endif

                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>


        </x-slot>
    </x-jet-dialog-modal>
</div>
