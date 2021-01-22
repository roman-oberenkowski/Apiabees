<div x-data="{
    isDeleteModalOpen: @entangle('isDeleteModalOpen'),
    isEditModalOpen: @entangle('isEditModalOpen')
    }">
    <x-jet-action-message :on="1">Test</x-jet-action-message>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Name
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Title
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Role
            </th>
            <th class="pr-4 py-3 bg-gray-50"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <div>
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm leading-5 font-medium text-gray-900">
                                Jane Cooper
                            </div>
                            <div class="text-sm leading-5 text-gray-500">
                                jane.cooper@example.com
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    <div class="text-sm leading-5 text-gray-900">Regional Paradigm Technician</div>
                    <div class="text-sm leading-5 text-gray-500">Optimization</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Active
                </span>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                    Admin
                </td>
                <td class="pr-4 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                    <a href="#" class="text-green-400 hover:text-green-900 pr-3" wire:click="$toggle('isEditModalOpen')" wire:loading.attr="disabled"><i class="fas fa-edit pr-2"></i>Edit</a>
                    <a href="#" class="text-red-600 hover:text-red-900" wire:click="$toggle('isDeleteModalOpen')" wire:loading.attr="disabled"><i class="fas fa-times pr-2"></i>Delete</a>
                </td>
            </tr>
        </div>
        </tbody>
    </table>

    <x-jet-dialog-modal wire:model="isDeleteModalOpen">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="__todo__" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="isEditModalOpen">
        <x-slot name="title">
            {{ __('Edit Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
