<div>
    <x-flash/>
    <div class="grid grid-cols-6 gap-6 p-3">
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="filter_state" value="By status:" />
            <x-select for="filter_state" wire:model="filter_state" :options="$filter_state_dropdown"  />
            <x-jet-input-error for="filter_state" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
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
                Acquired at
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Specie
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Population
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>

        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

        @foreach($beefamilies as $family)
            <div>
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($family->acquired_at)->format('d/m/Y')}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$family->species_name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$family->population}}

                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$this->family_status($family)}}
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">

                        @if($family->die_off_date==null)
                        <a href="#" class="text-red-600 hover:text-red-900"
                           wire:click="openBeeFamilyAssignHiveModal('{{$family->id}}')" wire:loading.attr="disabled">
                            <i class="fas fa-times pr-2"></i>Assign hive</a>
                        @endif
                        <a href="#" class="text-red-600 hover:text-red-900"
                           wire:click="openBeeFamilyDetailsModal('{{$family->id}}')" wire:loading.attr="disabled">
                            <i class="fas fa-times pr-2"></i>Details</a>
                        <a href="#" class="text-red-600 hover:text-red-900"
                           wire:click="openBeeFamilyDeleteModal('{{$family->id}}')" wire:loading.attr="disabled">
                            <i class="fas fa-times pr-2"></i>Delete</a>
                    </td>
                </tr>
            </div>
        @endforeach
        </tbody>
    </table>
        <div class="p-3">
        {{ $beefamilies->links() }}
    </div>
</div>
