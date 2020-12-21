<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Choose Hive') }}
        </x-slot>

        <x-slot name="content">
            {{ __("Logic") }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="choose" wire:loading.attr="disabled">
                {{ __('Choose') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
