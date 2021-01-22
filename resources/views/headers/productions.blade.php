<x-jet-nav-link href="{{ route('productions.index') }}" :active="request()->routeIs('productions.index')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('Produtions') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('productions.create') }}" :active="request()->routeIs('productions.create')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('New production') }}
</x-jet-nav-link>

