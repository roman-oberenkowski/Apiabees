<x-jet-nav-link href="{{ route('action-types.index') }}" :active="request()->routeIs('action-types.index')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('List of all action types') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('action-types.create') }}" :active="request()->routeIs('action-types.create')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('New type of action') }}
</x-jet-nav-link>
