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
            <x-sidebar-nav-link href="{{ route('actions.index') }}" :active="request()->is('actions')"> <i class="fas fa-bolt pr-5"></i>  {{ __('Actions') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('action-types.index') }}" :active="request()->is('action_types/*')"> <i class="fas fa-arrows-alt pr-3"></i>  {{ __('Action Types') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('apiaries.index') }}" :active="request()->is('apiaries')"> <i class="fas fa-house-damage pr-3"></i>  {{ __('Apiaries') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('attendances.index') }}" :active="request()->is('attendance')"> <i class="fas fa-check-square pr-4"></i>  {{ __('Attendance') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('bee-families.index') }}" :active="request()->is('bee-families')"> <i class="fab fa-blackberry pr-4"></i>  {{ __('Bee Families') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('employees.index') }}" :active="request()->is('employees/')"> <i class="fas fa-users pr-3"></i>  {{ __('Employees') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('hives.index') }}" :active="request()->is('hives')"> <i class="fab fa-hive pr-4"></i>  {{ __('Hives') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('honey-types.index') }}" :active="request()->is('honey_types/*')"> <i class="fas fa-grip-horizontal pr-4"></i>  {{ __('Honey types') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('productions.index') }}" :active="request()->is('productions/*')"> <i class="fab fa-houzz pr-5"></i>  {{ __('Productions') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('scanner.scan') }}" :active="request()->is('scanner.scan')"> <i class="fas fa-qrcode pr-3"></i>  {{ __('Scanner') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('species.index') }}" :active="request()->is('species/*')"> <i class="fas fa-paw pr-3"></i>  {{ __('Species') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('task-assignments.index') }}" :active="request()->is('task-assignments')"> <i class="fas fa-tasks pr-4"></i>  {{ __('Task assignments') }} </x-sidebar-nav-link>
            <x-sidebar-nav-link href="{{ route('task-types.index') }}" :active="request()->is('task_types/*')"> <i class="fas fa-stream pr-3"></i>  {{ __('Task types') }} </x-sidebar-nav-link>
        </div>
    </div>
</aside>
