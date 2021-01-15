<div>
    <x-flash />

    <div class="grid grid-cols-6 gap-6 p-3">
        <div class="col-span-6 sm:col-span-6">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="filter_employee_PESEL" value="by employee:" />
            <x-select for="filter_employee_PESEL" wire:model="filter_employee_PESEL" :options="$filter_employees_dropdown"  />
            <x-jet-input-error for="filter_employee_PESEL" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="filter_type_name"  value="by action type" />
            <x-select for="filter_type_name" wire:model="filter_type_name" :options="$filter_type_names_dropdown"  />
            <x-jet-input-error for="filter_type_name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="filter_description" value="{{ __('by description') }}" />
            <x-jet-input id="filter_description" type="text" class="mt-1 block w-full" wire:model="filter_description" autocomplete="filter_description"/>
            <x-jet-input-error for="filter_description" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="filter_date" value="{{ __('by date') }}" />
            <x-jet-input id="filter_date" type="date" class="mt-1 block w-full" wire:model="filter_date" autocomplete="filter_date"/>
            <x-jet-input-error for="filter_date" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label  value="{{ __('Filter') }}" />
            <x-jet-secondary-button wire:click="resetFilters()" wire:loading.attr="disabled">
                {{ __('Reset') }}
            </x-jet-secondary-button>
        </div>



    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Performed at
            </th>

            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Employee
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
                                    {{$action->performed_at}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{\App\Models\Employee::findOrFail($action->employee_PESEL)->first_name}}
                                    {{\App\Models\Employee::findOrFail($action->employee_PESEL)->last_name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$action->type_name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$this->formatDescription($action->description)}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                        <a href="#" class="text-red-600 hover:text-red-900" wire:click="openActionDetailsModal('{{$action->id}}')" wire:loading.attr="disabled"><i class="fas fa-times pr-2"></i>Details</a>
                    </td>
                    <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                         <a href="#" class="text-red-600 hover:text-red-900" wire:click="openActionDeleteModal('{{$action->id}}')" wire:loading.attr="disabled"><i class="fas fa-times pr-2"></i>Delete</a>
                    </td>

                </tr>
            </div>
        @endforeach
        </tbody>
    </table>
    <div class="p-3">
        {{ $actions->links() }}
    </div>

</div>
