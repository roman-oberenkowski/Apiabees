<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Choose Hive') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <x-flash/>
                <div class="grid grid-cols-6 gap-6 p-3">
                    <div class="col-span-6 sm:col-span-2">
                        <x-jet-label for="filter_apiary_code_name" value="Filter by apiary:" />
                        <x-select for="filter_apiary_code_name" wire:model="filter_apiary_code_name" :options="$filter_apiary_code_name_dropdown"  />
                        <x-jet-input-error for="filter_apiary_code_name" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <x-jet-label for="filter_state" value="Filter by state:" />
                        <x-select for="filter_state" wire:model="filter_state" :options="$filter_state_dropdown"  />
                        <x-jet-input-error for="filter_state" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>


                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Apiary code name
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            location row
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            location column
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            state
                        </th>
                        <th class="pr-4 py-3 bg-gray-50"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    @foreach($hives as $hive)
                        <div>
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{$hive->id}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                @if($hive->apiary_code_name!=null)
                                                    {{$hive->apiary_code_name}}
                                                @else
                                                    <i>Unassigned</i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                @if($hive->location_row!=null)
                                                    {{$hive->location_row}}
                                                @else
                                                    <i>Unassigned</i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                @if($hive->location_column!=null)
                                                    {{$hive->location_column}}
                                                @else
                                                    <i>Unassigned</i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                @if($hive->bee_family_id!=null)
                                                    Occupied
                                                @else
                                                    Empty
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <a href="#" class="text-red-600 hover:text-red-900"
                                       wire:click="choose('{{$hive->id}}')" wire:loading.attr="disabled"><i
                                            class="fas fa-times pr-2"></i>Choose</a>
                                </td>
                            </tr>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                <div class="p-3">
                    {{ $hives->links() }}
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
