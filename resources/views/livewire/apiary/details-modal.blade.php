<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __("Details") }}
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
                                        <x-jet-label for="code_name" value="{{ __('Code name') }}" />
                                        {{$this->g("code_name")}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        {{$this->g("name")}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="area" value="{{ __('Area') }}" />
                                        {{$this->g("area")}}m<sup>2</sup>
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
                                    <div class="col-span-6 ">
                                        <x-jet-label for="City" value="{{ __('City') }}" />
                                        {{$this->g("city")}}
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="Street" value="{{ __('Street') }}" />
                                        {{$this->g("street")}}
                                    </div>

                                    <div class="col-span-6 ">
                                        <x-jet-label for="Parcel" value="{{ __('Parcel') }}" />
                                        {{$this->g("parcel")}}
                                    </div>
                                    <div class="col-span-6 ">
                                        <x-jet-label for="Latitude" value="{{ __('Latitude') }}" />
                                        {{$this->g("latitude")}}
                                    </div>
                                    <div class="col-span-6 ">
                                        <x-jet-label for="Longitude" value="{{ __('Longitude') }}" />
                                        {{$this->g("longitude")}}
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
                        <x-slot name="title">Hives</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="rows" value="{{ __('Rows') }}" />
                                        {{$this->g("row_num")}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="columns" value="{{ __('Columns') }}" />
                                        {{$this->g("col_num")}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="occupancy" value="{{ __('Occupancy') }}" />
                                        @if(strlen($this->g("code_name"))>0)
                                            {{$hives_placed=\App\Models\Hive::where('apiary_code_name',$this->g("code_name"))->count()}}/{{$hives_max=$this->g("col_num")*$this->g("row_num")}}
                                            ({{round($hives_placed/$hives_max*100,1)}}%)
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="some more" value="{{ __('some more') }}" />
                                        maybe something like density of hives/square meter?
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
                        <x-slot name="title">Other</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <x-jet-label for="rows" value="{{ __('Production') }}" />
                                        some production info here
                                    </div>
                                    <div class="col-span-6">
                                        <x-jet-label for="rows" value="{{ __('Tasks') }}" />
                                        some tasks info here
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="openApiaryEditModal" wire:loading.attr="disabled">
                {{ __('Edit') }}
            </x-jet-button>
            <x-jet-secondary-button wire:click="redirectApiariesHivesIndex" wire:loading.attr="disabled">
                {{ __('Hives on this apiary') }}
            </x-jet-secondary-button>
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>




        </x-slot>
    </x-jet-dialog-modal>
</div>
