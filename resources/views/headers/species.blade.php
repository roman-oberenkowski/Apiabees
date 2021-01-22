<x-jet-nav-link href="{{ route('species.index') }}" :active="request()->routeIs('species.index')" class="text-lg">
    <i class="fas fa-table pr-1"></i> {{ __('List of all species') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('species.create') }}" :active="request()->routeIs('species.create')" class="text-lg">
    <i class="fas fa-plus pr-1"></i> {{ __('New species') }}
</x-jet-nav-link>

