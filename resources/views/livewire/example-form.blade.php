<div class="overflow-hidden sm:rounded-md">

    <form submit="__TODO__" {{--      wire:submit.prevent="{{ _______ }}"--}} >
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="current_password" value="{{ __('Current Password') }}" />
                <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
                <x-jet-input-error for="current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="password" value="{{ __('New Password') }}" />
                <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
                <x-jet-input-error for="password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3 sm:col-start-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                <x-jet-input-error for="password_confirmation" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-start-4 sm:col-span-3">
                <label for="country" class="block text-sm font-medium leading-5 text-gray-700">Country / Region</label>
                <select id="country" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    <option>United States</option>
                    <option>Canada</option>
                    <option>Mexico</option>
                </select>
            </div>
            <div class="col-span-6">
                <x-text-area id="about" placeholder="you@example.com" subdescription="Brief description for your profile. URLs are hyperlinked.">About</x-text-area>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <legend class="text-base leading-6 font-medium text-gray-900">By Email</legend>
                <div class="mt-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="comments" type="checkbox" class="form-checkbox h-4 w-4 text-yellow-400 transition duration-150 ease-in-out">
                        </div>
                        <div class="ml-3 text-sm leading-5">
                            <label for="comments" class="font-medium text-gray-700">Comments</label>
                            <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="candidates" type="checkbox" class="form-checkbox h-4 w-4 text-yellow-400 transition duration-150 ease-in-out">
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <label for="candidates" class="font-medium text-gray-700">Candidates</label>
                                <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="offers" type="checkbox" class="form-checkbox h-4 w-4 text-yellow-400 transition duration-150 ease-in-out">
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <label for="offers" class="font-medium text-gray-700">Offers</label>
                                <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <legend class="text-base leading-6 font-medium text-gray-900">Push Notifications</legend>
                <p class="text-sm leading-5 text-gray-500">These are delivered via SMS to your mobile phone.</p>
                <div class="mt-4">
                    <div class="flex items-center">
                        <input id="push_everything" name="push_notifications" type="radio" class="form-radio h-4 w-4 text-yellow-400 transition duration-150 ease-in-out">
                        <label for="push_everything" class="ml-3">
                            <span class="block text-sm leading-5 font-medium text-gray-700">Everything</span>
                        </label>
                    </div>
                    <div class="mt-4 flex items-center">
                        <input id="push_email" name="push_notifications" type="radio" class="form-radio h-4 w-4 text-yellow-400 transition duration-150 ease-in-out">
                        <label for="push_email" class="ml-3">
                            <span class="block text-sm leading-5 font-medium text-gray-700">Same as email</span>
                        </label>
                    </div>
                    <div class="mt-4 flex items-center">
                        <input id="push_nothing" name="push_notifications" type="radio" class="form-radio h-4 w-4 text-yellow-400 transition duration-150 ease-in-out">
                        <label for="push_nothing" class="ml-3">
                            <span class="block text-sm leading-5 font-medium text-gray-700">No push notifications</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 mt-4 rounded">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Save') }}
            </x-jet-button>
        </div>
    </form>
</div>

