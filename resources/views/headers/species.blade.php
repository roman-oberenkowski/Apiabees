<x-jet-nav-link href="{{ route('species.index') }}" :active="request()->routeIs('species.index')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('List of all species') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('species.create') }}" :active="request()->routeIs('species.create')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('New species') }}
</x-jet-nav-link>

