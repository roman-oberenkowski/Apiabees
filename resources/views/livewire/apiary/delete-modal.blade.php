<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Delete apiary?') }}
        </x-slot>

        <x-slot name="content">
            {{ __("Are you sure you want to delete selected apiary? Confirming will delete all data assosiated with this apiary (tasks, honey/wax produtions. All hives currently on the apiary will be kept, but their placement will be reset (sent to storage).") }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
                {{ __('Delete!') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
