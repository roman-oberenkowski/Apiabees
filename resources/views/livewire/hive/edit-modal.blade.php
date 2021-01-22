<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Move hive') }}
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
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="material" value="Material" />
                                    <x-select for="material" wire:model="material" :options="$material_dropdown"  />
                                    <x-jet-input-error for="material" class="mt-2" />
                                </div>

                                <div class="col-span-6 sm:col-span-3"></div>
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="nfc_tag" value="{{ __('NFC tag') }}" />
                                    <x-jet-input id="nfc_tag" type="text" class="mt-1 block w-full" wire:model="nfc_tag" autocomplete="nfc_tag"  />
                                    <x-jet-input-error for="nfc_tag" class="mt-2" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="qr_code" value="{{ __('QR code') }}" />
                                    <x-jet-input id="qr_code" type="text" class="mt-1 block w-full" wire:model="qr_code" autocomplete="qr_code"  />
                                    <x-jet-input-error for="qr_code" class="mt-2" />
                                </div>
                                <div class="col-span-6 sm:col-span-2">
                                    <x-jet-label  value="{{ __('Fast NFC/QR scan') }}" />
                                    <x-jet-secondary-button wire:click="loadScanNFCQR()" wire:loading.attr="disabled">
                                        {{ __('Load') }}
                                    </x-jet-secondary-button>
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
                    <x-slot name="title">Placement information</x-slot>
                    <x-slot name="description"></x-slot>
                </x-jet-section-title>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="apiary_code_name" value="Apiary" />
                                    <x-select for="apiary_code_name" wire:model="apiary_code_name" :options="$apiary_code_name_dropdown"  />
                                    <x-jet-input-error for="apiary_code_name" class="mt-2" />
                                </div>
                                <div class="col-span-6 sm:col-span-3"></div>
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="location_row" value="{{ __('Row') }}" />
                                    <x-jet-input id="location_row" type="text" class="mt-1 block w-full" wire:model="location_row" autocomplete="location_row"  />
                                    <x-jet-input-error for="location_row" class="mt-2" />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="location_column" value="{{ __('Column') }}" />
                                    <x-jet-input id="location_column" type="text" class="mt-1 block w-full" wire:model="location_column" autocomplete="location_column"  />
                                    <x-jet-input-error for="location_column" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled" class="mr-3">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="choose" wire:loading.attr="disabled">
                {{ __('Confirm') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
