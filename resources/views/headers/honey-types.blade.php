<x-jet-nav-link href="{{ route('honey-types.index') }}" :active="request()->routeIs('honey-types.index')" class="text-lg">
    <i class="fas fa-table pr-1"></i> {{ __('List of all honey types') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('honey-types.create') }}" :active="request()->routeIs('honey-types.create')" class="text-lg">
    <i class="fas fa-plus pr-1"></i> {{ __('New type of honey') }}
</x-jet-nav-link>

