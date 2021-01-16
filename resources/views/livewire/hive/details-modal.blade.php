<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __("Hive details") }}
        </x-slot>

        <x-slot name="content">
            <div class="p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-jet-section-title>
                        <x-slot name="title">General information</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="code_name" value="{{ __('ID') }}"/>
                                        {{$this->hive_id}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="name" value="{{ __('Material') }}"/>
                                        {{$this->material}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="area" value="{{ __('NFC tag') }}"/>
                                        @if ($this->nfc_tag!=null)
                                        {{$this->nfc_tag}}
                                        @else
                                            None
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="area" value="{{ __('QR code') }}"/>
                                        @if ($this->qr_code!=null)
                                            {{$this->qr_code}}
                                        @else
                                            None
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
                        <x-slot name="title">Location</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="code_name" value="{{ __('Apiary code name') }}"/>
                                        @if ($this->apiary_code_name!=null)
                                            {{$this->apiary_code_name}}
                                        @else
                                            Unassigned
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="name" value="{{ __('Row') }}"/>
                                        @if ($this->location_row!=null)
                                            {{$this->location_row}}
                                        @else
                                            Unassigned
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="area" value="{{ __('Column') }}"/>
                                        @if ($this->location_column!=null)
                                            {{$this->location_column}}
                                        @else
                                            Unassigned
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
                        <x-slot name="title">Bee family</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="code_name" value="{{ __('Status') }}"/>
                                        @if ($this->bee_family_id!=null)
                                            Occupied
                                        @else
                                            Empty
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            @if($this->extended)
{{--                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">--}}
{{--                    {{ __('[hives at this apiary]') }}--}}
{{--                </x-jet-secondary-button>--}}
                <x-jet-secondary-button wire:click="openHiveEditModal" wire:loading.attr="disabled">
                    {{ __('[Edit]') }}
                </x-jet-secondary-button>
            @endif
            @if($this->bee_family_id!=null)
                <x-jet-secondary-button wire:click="openBeeFamilyDetailsModal" wire:loading.attr="disabled">
                    {{ __('Bee family details') }}
                </x-jet-secondary-button>
            @endif
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
