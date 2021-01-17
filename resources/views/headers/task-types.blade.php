<x-jet-nav-link href="{{ route('task-types.index') }}" :active="request()->routeIs('task-types.index')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('List of all task types') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('task-types.create') }}" :active="request()->routeIs('task-types.create')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('New type of task') }}
</x-jet-nav-link>

