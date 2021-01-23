<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Assign to hive') }}
        </x-slot>

        <x-slot name="content">
            <div class="p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-jet-section-title>
                        <x-slot name="title">Current hive</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        @if($this->old_hive_id!=null)
                                            <x-jet-secondary-button wire:click="openOldHiveDetailsModal" wire:loading.attr="disabled" class="pm-3">
                                                {{ __('Details') }}
                                            </x-jet-secondary-button>
                                        @else
                                            <div class="col-span-6 sm:col-span-3">
                                                None
                                            </div>
                                        @endif

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
                        <x-slot name="title">Target hive</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-6">
                                        <div class="col-span-6 sm:col-span-6">
                                            <div class="col-span-6 sm:col-span-3 mb-3">
                                                @if($this->new_hive_id!=null)

                                                        Selected <br />
                                                    <x-jet-secondary-button wire:click="openNewHiveDetailsModal" wire:loading.attr="disabled" class="pm-3">
                                                        {{ __('Details') }}
                                                    </x-jet-secondary-button>
                                                    <x-jet-secondary-button wire:click="resetSelectedTargetHive" wire:loading.attr="disabled" class="pm-3">
                                                        {{ __('Reset') }}
                                                    </x-jet-secondary-button>
                                                @else
                                                        None selected
                                                    </div>
                                                @endif
                                        </div>
                                        <div class="col-span-6 sm:col-span-6">
                                            <x-jet-secondary-button wire:click.prevent="chooseHive" wire:loading.attr="disabled">
                                                {{ __('Choose Hive') }}
                                            </x-jet-secondary-button>
                                            <x-jet-input-error for="choosen_hive" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="col-span-12 flex items-center justify-end bg-gray-50 text-right sm:px-6 mt-4 rounded ">
                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled" class="mr-3">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button wire:click="assign">
                    {{ __('Assign') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
