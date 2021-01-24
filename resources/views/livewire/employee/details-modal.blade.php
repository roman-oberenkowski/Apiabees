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
                                        {{$name}}
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
                                        {{$first_name}}
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="last_name" value="{{ __('Last name') }}" />
                                        {{$last_name}}
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="PESEL" value="{{ __('PESEL') }}" />
                                        {{$PESEL}}
                                    </div>

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
                                    <div class="col-span-6 ">
                                        <x-jet-button wire:click="openEditModalForm" wire:loading.attr="disabled">
                                            {{ __('Edit') }}
                                        </x-jet-button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>Latest actions</div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Performed at
                    </th>

                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Action type
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        description
                    </th>
                    <th class="pr-4 py-3 bg-gray-50"></th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                @foreach($actions as $action)
                    <div>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div >
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$action['performed_at']}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div >
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$action['type_name']}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div >
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$this->formatDescription($action['description'])}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                @if($action['id']!=null)
                                <a href="#" class="text-gray-400 hover:text-gray-900" wire:click="openActionDetailsModal('{{$action['id']}}')" wire:loading.attr="disabled"><i class="fas fa-address-card pr-2"></i>Details</a>
                                @endif
                            </td>
                        </tr>
                    </div>
                @endforeach
                </tbody>
            </table>
            <div>Latest attendances</div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Started at
                    </th>

                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Finished at
                    </th>

                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                @foreach($attendances as $attendance)
                    <div>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div >
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$attendance['started_at']}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div >
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            @if($attendance['finished_at']==null)
                                                Still at work
                                            @else
                                                {{$attendance['finished_at']}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </div>
                @endforeach
                </tbody>
            </table>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="redirectEmployeeActionsIndex" wire:loading.attr="disabled">
                {{ __('More actions') }}
            </x-jet-secondary-button>
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>




        </x-slot>
    </x-jet-dialog-modal>
</div>
