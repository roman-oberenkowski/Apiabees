<x-jet-nav-link href="{{ route('action-types.index') }}" :active="request()->routeIs('action-types.index')" class="text-lg">
    <i class="fas fa-table pr-1"></i> {{ __('List of all action types') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('action-types.create') }}" :active="request()->routeIs('action-types.create')" class="text-lg">
    <i class="fas fa-plus pr-1"></i> {{ __('New type of action') }}
</x-jet-nav-link>

