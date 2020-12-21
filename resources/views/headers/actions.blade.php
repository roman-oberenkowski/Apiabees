<x-jet-nav-link href="{{ route('actions.index') }}" :active="request()->routeIs('actions.index')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('List of all actions') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('actions.create') }}" :active="request()->routeIs('actions.create')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('New action') }}
</x-jet-nav-link>

