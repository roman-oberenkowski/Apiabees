<x-jet-nav-link href="{{ route('state-types.index') }}" :active="request()->routeIs('task-types.index')" class="text-lg">
    <i class="fas fa-table pr-1"></i> {{ __('List of all state types') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('state-types.create') }}" :active="request()->routeIs('task-types.create')" class="text-lg">
    <i class="fas fa-plus pr-1"></i> {{ __('New type of state') }}
</x-jet-nav-link>

