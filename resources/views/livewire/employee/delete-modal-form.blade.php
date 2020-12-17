<div>
    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Employee? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="destroy({{$PESEL}})" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
