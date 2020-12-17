<div>
    <x-flash />

    <div class="grid grid-cols-6 gap-6 p-3">
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="search__first_name" value="{{ __('First name') }}" />
            <x-jet-input id="search__first_name" type="text" class="mt-1 block w-full" wire:model="search__first_name" autocomplete="search__first_name"/>
            <x-jet-input-error for="search__first_name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="search__last_name" value="{{ __('Last name') }}" />
            <x-jet-input id="search__last_name" type="text" class="mt-1 block w-full" wire:model="search__last_name" autocomplete="search__last_name" />
            <x-jet-input-error for="search__last_name" class="mt-2" />
        </div>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Name
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Employed
            </th>
            <th class="pr-4 py-3 bg-gray-50"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($employees as $employee)
            <div>
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$employee->first_name}} {{$employee->last_name}}
                                </div>
                                <div class="text-sm leading-5 text-gray-500">
                                    {{$employee->email}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="text-sm leading-5 text-gray-900">
                            {{   \Carbon\Carbon::parse($employee->date_of_employment)->format('d/m/Y')   }}
                        </div>
                        <div class="text-sm leading-5 text-red-800">
                            @isset($employee->date_of_release)
                                {{   \Carbon\Carbon::parse($employee->date_of_release)->format('d/m/Y')   }}
                            @endisset
                        </div>
                    </td>
                    <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                        <a href="#" class="text-gray-400 hover:text-gray-900 pr-3" wire:click="openModal('details', {{$employee->PESEL}})" wire:loading.attr="disabled"><i class="fas fa-address-card pr-2"></i>Details</a>
                        <a href="#" class="text-green-400 hover:text-green-900 pr-3" wire:click="openModal('edit', {{$employee->PESEL}})" wire:loading.attr="disabled"><i class="fas fa-trash pr-2"></i>Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900" wire:click="openModal('delete', {{$employee->PESEL}})" wire:loading.attr="disabled"><i class="fas fa-times pr-2"></i>Delete</a>
                    </td>
                </tr>
            </div>
        @endforeach
        </tbody>
    </table>
    <div class="p-3">
        {{ $employees->links() }}
    </div>
    @livewire('employee.edit-modal-form')
    @livewire('employee.delete-modal-form')
</div>
