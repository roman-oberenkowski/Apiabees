<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __("All family states") }}
        </x-slot>
        <x-slot name="content">
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
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">

                    </th>

                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($states as $state)
                    <div>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$state->checked_at}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$state->state_type_name}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{$this->formatDescription($state->inspection_description)}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                @if($state->id!=null)
                                    <a href="#" class="text-red-600 hover:text-red-900"
                                       wire:click="openFamilyStateDetailsModal('{{$state->id}}')"
                                       wire:loading.attr="disabled"><i class="fas fa-times pr-2"></i>Details</a>
                                @endif
                            </td>
                        </tr>
                    </div>
                @endforeach
                </tbody>
            </table>

            <div class="p-3">
            {{ $states->links() }}
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
