<div xmlns:wire="http://www.w3.org/1999/xhtml">
        <x-flash />
        <form wire:submit.prevent="store" method="POST">
            @csrf
            <div class="p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <x-jet-section-title>
                        <x-slot name="title">Assign task</x-slot>
                        <x-slot name="description"></x-slot>
                    </x-jet-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="task_type_name" value="Task type" />
                                        <x-select for="task_type_name" wire:model="task_type_name" :options="$task_type_name_dropdown"  />
                                        <x-jet-input-error for="task_type_name" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="employee_PESEL" value="Employee" />
                                        <x-select for="employee_PESEL" wire:model="employee_PESEL" :options="$employee_PESEL_dropdown"  />
                                        <x-jet-input-error for="employee_PESEL" class="mt-2" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-jet-label for="apiary_code_name" value="Apiary" />
                                        <x-select for="apiary_code_name" wire:model="apiary_code_name" :options="$apiary_code_name_dropdown"  />
                                        <x-jet-input-error for="apiary_code_name" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 mt-4 rounded ">
                <x-jet-button>
                    {{ __('Assign') }}
                </x-jet-button>
            </div>
        </form>
    </div>
