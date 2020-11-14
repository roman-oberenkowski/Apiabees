<x-app-layout>
    <x-slot name="header">
        @include('headers.example')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                                            <a href="#" class="text-green-400 hover:text-green-900 pr-3">Edit</a>
                                            <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                        </td>
                                    </tr>
                                    <x-jet-dialog-modal >
                                        <x-slot name="title">
                                            {{ __('Delete Account') }}
                                        </x-slot>

                                        <x-slot name="content">
                                            {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                                            <div class="mt-4">
                                                <x-jet-input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}"
                                                             x-ref="password"/>

                                                <x-jet-input-error for="password" class="mt-2" />
                                            </div>
                                        </x-slot>

                                        <x-slot name="footer">
                                            <x-jet-secondary-button >
                                                {{ __('Nevermind') }}
                                            </x-jet-secondary-button>

                                            <x-jet-danger-button class="ml-2" >
                                                {{ __('Delete Account') }}
                                            </x-jet-danger-button>
                                        </x-slot>
                                    </x-jet-dialog-modal>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
