<x-jet-nav-link href="{{ route('hives.index') }}" :active="request()->routeIs('action-types.index')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('List of all hives') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('hives.create') }}" :active="request()->routeIs('action-types.create')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('New hive') }}
</x-jet-nav-link>

