<aside class="bg-gradient-to-b from-dark_blue to-teal-900 text-gray-100 md:min-h-screen shadow overflow-hidden shadow-2xl">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-2">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
            <a href="{{ route('dashboard') }}" class="mx-3">
                <x-jet-application-mark class="block h-9 w-auto" />
            </a>
            <h1 class="font-semibold text-3xl">Apiabees</h1>
        </div>
        <div class="font-semibold text-xl text-gray-100 leading-tight py-4">
            <x-sidebar-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"> <i class="fab fa-accusoft pr-1"></i>  {{ __('Dashboard') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('employees.index') }}" :active="request()->is('employees/')"> <i class="fab fa-accusoft pr-1"></i>  {{ __('Employees') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('action-types.index') }}" :active="request()->is('action_types/*')"> <i class="fab fa-accusoft pr-1"></i>  {{ __('Action Types') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('actions.index') }}" :active="request()->is('actions')"> <i class="fab fa-accusoft pr-1"></i>  {{ __('Actions') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('hives.index') }}" :active="request()->is('hives')"> <i class="fab fa-accusoft pr-1"></i>  {{ __('Hives') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('apiaries.index') }}" :active="request()->is('apiaries')"> <i class="fab fa-accusoft pr-1"></i>  {{ __('Apiaries') }} </x-sidebar-nav-link>
        </div>
    </div>
</aside>
