<x-jet-nav-link href="{{ route('apiaries.index') }}" :active="request()->routeIs('apiaries.index')" class="text-lg">
    <i class="fas fa-table pr-1"></i> {{ __('List of apiaries') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('apiaries.create') }}" :active="request()->routeIs('apiaries.create')" class="text-lg">
    <i class="fas fa-plus pr-1"></i> {{ __('New apiary') }}
</x-jet-nav-link>

