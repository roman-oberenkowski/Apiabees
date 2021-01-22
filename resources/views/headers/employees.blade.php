<x-jet-nav-link href="{{ route('employees.index') }}" :active="request()->routeIs('employees.index')" class="text-lg">
    <i class="fas fa-table pr-1"></i> {{ __('List of employees') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('employees.create') }}" :active="request()->routeIs('employees.create')" class="text-lg">
    <i class="fas fa-plus pr-1"></i> {{ __('New employee') }}
</x-jet-nav-link>
