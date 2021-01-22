<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <x-flash />
    <form wire:submit.prevent="store" method="POST">
        @csrf
        <div class="p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="mt-5 md:mt-0 md:col-span-3">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <x-jet-input-error for="push_notifications" class="mt-2" />
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
                                @if($isHoney)
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="honey_type_name" value="Honey type" />
                                    <x-select for="honey_type_name" wire:model="honey_type_name" :options="$honey_type_name_dropdown"  />
                                    <x-jet-input-error for="honey_type_name" class="mt-2" />
                                </div>
                                @endif
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="produced_weight" value="{{ __('Produced weight') }}" />
                                    <x-jet-input id="produced_weight" type="text" class="mt-1 block w-full" wire:model="produced_weight" autocomplete="produced_weight" />
                                    <x-jet-input-error for="produced_weight" class="mt-2" />
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="produced_at" value="{{ __('Date of production') }}" />
                                    <x-jet-input id="produced_at" type="date" class="mt-1 block w-full" wire:model="produced_at" autocomplete="produced_at"/>
                                    <x-jet-input-error for="produced_at" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 mt-4 rounded ">
            <x-jet-button>
                {{ __('Create') }}
            </x-jet-button>
        </div>
    </form>
</div>
