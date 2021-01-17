<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Delete Species') }}
        </x-slot>

        <x-slot name="content">
            {{ __("Are you sure you want to delete specie $name?") }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="destroy()" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
