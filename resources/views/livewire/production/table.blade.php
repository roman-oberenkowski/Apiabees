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
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="isHoney" value="Type of production" />
            <x-select for="isHoney" wire:model="isHoney" :options="$isHoney_dropdown"  />
            <x-jet-input-error for="isHoney" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="apiary_code_name" value="Apiary" />
            <x-select for="apiary_code_name" wire:model="apiary_code_name" :options="$apiary_code_name_dropdown"  />
            <x-jet-input-error for="apiary_code_name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="from_date" value="{{ __('From date') }}" />
            <x-jet-input id="from_date" type="date" class="mt-1 block w-full" wire:model="from_date" autocomplete="from_date"/>
            <x-jet-input-error for="from_date" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="to_date" value="{{ __('To date') }}" />
            <x-jet-input id="to_date" type="date" class="mt-1 block w-full" wire:model="to_date" autocomplete="to_date"/>
            <x-jet-input-error for="to_date" class="mt-2" />
        </div>
        @if($isHoney)
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="honey_type_name" value="Honey type" />
                <x-select for="honey_type_name" wire:model="honey_type_name" :options="$honey_type_name_dropdown"  />
                <x-jet-input-error for="honey_type_name" class="mt-2" />
            </div>
        @else
            <div class="col-span-6 sm:col-span-3">
            </div>
        @endif
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label  value="{{ __('Filter') }}" />
            <x-jet-secondary-button wire:click="resetFilters()" wire:loading.attr="disabled">
                {{ __('Reset') }}
            </x-jet-secondary-button>
        </div>
    </div>
    @if(sizeof($productions)>=2)
    <div class="h-96 mb-4 mx-5">
        <livewire:livewire-column-chart
            key="{{ $column_chart->reactiveKey() }}"
            :column-chart-model="$column_chart"
        />
    </div>

    <div class="h-96 mb-4 mx-5">
        <livewire:livewire-line-chart
            key="{{ $line_chart->reactiveKey() }}"
            :line-chart-model="$line_chart"
        />
    </div>
    @endif

    < class="min-w-full divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Production date
                </th>

                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Apiary code name
                </th>
                @if($isHoney)
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Honey type name
                </th>
                @endif
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Produced weight
                </th>
                <th class="pr-4 py-3 bg-gray-50"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

            @foreach($productions as $production)
                <div>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="flex items-center">
                                <div >
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        {{\Carbon\Carbon::parse($production->produced_at)->format('d/m/Y')   }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        {{$production->apiary_code_name}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        @if($isHoney)
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="flex items-center">
                                <div >
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        {{$production->honey_type_name}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        @endif
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="flex items-center">
                                <div >
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        {{$production->produced_weight}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                            <a href="#" class="text-red-600 hover:text-red-900"

                           wire:click="openProductionDeleteModal('{{$production->id}}')" wire:loading.attr="disabled"><i
                                class="fas fa-times pr-2"></i>Delete</a>
                        </td>
                    </tr>
                </div>
            @endforeach
            </tbody>
        </table>
    <div class="p-3">
        {{ $productions->links() }}
    </div>
    <div>
        <p>Overall, during this time {{$produced}}kg. of @if($isHoney) honey @else wax @endif has been produced.</p>
    </div>

</div>
