<x-jet-nav-link href="{{ route('bee-families.index') }}" :active="request()->routeIs('bee-families.index')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('List of bee families') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('bee-families.create') }}" :active="request()->routeIs('bee-families.create')" class="text-lg">
    <i class="fab fa-accusoft pr-1"></i> {{ __('New bee family') }}
</x-jet-nav-link>

