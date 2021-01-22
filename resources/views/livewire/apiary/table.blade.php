<div>
    <x-flash/>
    <div class="grid grid-cols-6 gap-6 p-3">
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="search_code_name" value="{{ __('Filter by code name') }}"/>
            <x-jet-input id="search_code_name" type="text" class="mt-1 block w-full" wire:model="search_code_name"
                         autocomplete="search_code_name"/>
            <x-jet-input-error for="search_code_name" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="search_name" value="{{ __('Filter by name') }}"/>
            <x-jet-input id="search_name" type="text" class="mt-1 block w-full" wire:model="search_name"
                         autocomplete="search_name"/>
            <x-jet-input-error for="search_name" class="mt-2"/>
        </div>
        <div> add reset button?</div>
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
                Code name
            </th>

            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Name
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Area
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Hives/Max hives
            </th>
            <th class="pr-4 py-3 bg-gray-50">Actions</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

        @foreach($apiaries as $apiary)
            <div>
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$apiary->code_name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$apiary->name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$apiary->area}}m<sup>2</sup>

                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{\App\Models\Hive::where('apiary_code_name',$apiary->code_name)->count()}}/{{$apiary->col_num*$apiary->row_num}}
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                        <a href="#" class="text-red-600 hover:text-red-900"
                           wire:click="openApiaryDeleteModal('{{$apiary->code_name}}')" wire:loading.attr="disabled">
                            <i class="fas fa-times pr-2"></i>Delete</a>
                        <a href="#" class="text-gray-400 hover:text-gray-900"
                           wire:click="openApiaryDetailsModal('{{$apiary->code_name}}')" wire:loading.attr="disabled">
                            <i class="fas fa-address-card pr-2"></i>Details</a>
                        <a href="#" class="text-green-400 hover:text-green-900"
                           wire:click="openApiaryEditModal('{{$apiary->code_name}}')" wire:loading.attr="disabled">
                            <i class="fas fa-edit pr-2"></i>Edit</a>
                    </td>
                </tr>
            </div>
        @endforeach
        </tbody>
    </table>
    <div class="p-3">
        {{ $apiaries->links() }}
    </div>
</div>
