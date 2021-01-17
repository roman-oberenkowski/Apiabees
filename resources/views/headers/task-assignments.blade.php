<x-jet-nav-link href="{{ route('task-assignments.index') }}" :active="request()->routeIs('task-assignments.index')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('List of all task assignments') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('task-assignments.create') }}" :active="request()->routeIs('task-assignments.create')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('Assign task') }}
</x-jet-nav-link>

