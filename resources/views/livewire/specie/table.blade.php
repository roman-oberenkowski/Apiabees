<div>
    <x-flash />

    <div class="grid grid-cols-6 gap-6 p-3">
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="search__name" value="{{ __('Filter') }}" />
            <x-jet-input id="search__name" type="text" class="mt-1 block w-full" wire:model="search__name" autocomplete="search__name"/>
            <x-jet-input-error for="search__name" class="mt-2" />
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
                Speice name
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Latin name
            </th>
            <th class="pr-4 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Is aggressive?
            </th>

            <th class="pr-4 py-3 bg-gray-50"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

        @foreach($species as $specie)
            <div>
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$specie->name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div >
                                <div class="text-sm leading-5 font-medium text-gray-900">
                                    {{$specie->latin_name}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center text-center content-center">
                            <div class="text-sm leading-5 font-medium text-gray-900 items-center text-center content-center w-full">
                                @if($specie->is_aggressive)
                                    <i class="fas fa-check text-green-600"></i>
                                @else
                                    <i class="fas fa-times text-red-600"></i>
                                @endif
                            </div>
                        </div>
                    </td>

                    <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                         <a href="#" class="text-red-600 hover:text-red-900" wire:click="openDeleteModal('{{base64_encode($specie->name)}}')" wire:loading.attr="disabled"><i class="fas fa-times pr-2"></i>Delete</a>
                    </td>
                </tr>
            </div>
        @endforeach
        </tbody>
    </table>
    <div class="p-3">
        {{ $species->links() }}
    </div>

</div>
