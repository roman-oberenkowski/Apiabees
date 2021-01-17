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
            <x-jet-label for="filter_employee_PESEL" value="Filter by employee:" />
            <x-select for="filter_employee_PESEL" wire:model="filter_employee_PESEL" :options="$filter_employee_PESEL_dropdown"  />
            <x-jet-input-error for="filter_employee_PESEL" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="filter_task_type_name"  value="Filter by task type" />
            <x-select for="filter_task_type_name" wire:model="filter_task_type_name" :options="$filter_task_type_name_dropdown"  />
            <x-jet-input-error for="filter_task_type_name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="filter_apiary_code_name"  value="Filter by apiary code name" />
            <x-select for="filter_apiary_code_name" wire:model="filter_apiary_code_name" :options="$filter_apiary_code_name_dropdown"  />
            <x-jet-input-error for="filter_apiary_code_name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="filter_date" value="{{ __('Filter by date') }}" />
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
                Assignment date
            </th>

            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Employee
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Task type
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Apiary code name
            </th>
            <th class="pr-4 py-3 bg-gray-50"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

        @foreach($task_assignments as $ta)
            <div>
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{   \Carbon\Carbon::parse($ta->assignment_date)->format('d/m/Y')   }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{\App\Models\Employee::findOrFail($ta->employee_PESEL)->first_name}}
                                    {{\App\Models\Employee::findOrFail($ta->employee_PESEL)->last_name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$ta->task_type_name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$ta->apiary_code_name}}
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                         <a href="#" class="text-red-600 hover:text-red-900" wire:click="openTaskAssignmentDeleteModal('{{$ta->id}}')" wire:loading.attr="disabled"><i class="fas fa-times pr-2"></i>Delete</a>
                    </td>
                </tr>
            </div>
        @endforeach
        </tbody>
    </table>
    <div class="p-3">
        {{ $task_assignments->links() }}
    </div>

</div>
