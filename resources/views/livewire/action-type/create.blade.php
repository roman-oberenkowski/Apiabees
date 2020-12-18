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
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="name" value="{{ __('Please provide new Action Type') }}" />
                                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name" autocomplete="name"  required/>
                                    <x-jet-input-error for="name" class="mt-2" />
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
