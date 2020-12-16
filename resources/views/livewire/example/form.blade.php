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
                @php
                    $options = [
                        ['name' => 'test', 'value' => 'test', 'checked' => true],
                       ['name' => 'test2', 'value' => 'test2', 'checked' => false]
                     ];
                @endphp
                <x-jet-label for="country" value="Country:" />
                <x-select for="country" :options="$options" />
                <x-jet-input-error for="country" class="mt-2" />
            </div>
            <div class="col-span-6">
                <x-jet-label for="about" value="About:" />
                <x-text-area for="about" placeholder="you@example.com" subdescription="Brief description for your profile. URLs are hyperlinked." rows="3">About</x-text-area>
                <x-jet-input-error for="about" class="mt-2" />

            </div>
            <div class="col-span-6 sm:col-span-3">
                <legend class="text-base leading-6 font-medium text-gray-900">By Email</legend>
                <div class="mt-4">
                    <x-checkbox for="comments" value="1">
                        Comments <br/>
                        <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                    </x-checkbox>
                    <div class="mt-4">
                        <x-checkbox for="candidates" value="1">
                            Candidates <br/>
                            <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                        </x-checkbox>
                    </div>
                    <div class="mt-4">
                        <x-checkbox for="offers" value="1">
                            Offers <br/>
                            <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                        </x-checkbox>
                    </div>
                </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <legend class="text-base leading-6 font-medium text-gray-900">Push Notifications</legend>
                <p class="text-sm leading-5 text-gray-500">These are delivered via SMS to your mobile phone.</p>
                <div class="mt-4">
                    <x-radio value="1" checked for="push_everything" name="push_notifications">
                        <span class="block text-sm leading-5 font-medium text-gray-700">Everything</span>
                    </x-radio>
                    <x-radio value="2" checked for="push_email" name="push_notifications">
                        <span class="block text-sm leading-5 font-medium text-gray-700">Send an email</span>
                    </x-radio>
                    <x-radio value="3" checked for="push_nothing" name="push_notifications">
                        <span class="block text-sm leading-5 font-medium text-gray-700">No notifications</span>
                    </x-radio>
                </div>
                <x-jet-input-error for="push_notifications" class="mt-2" />
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

