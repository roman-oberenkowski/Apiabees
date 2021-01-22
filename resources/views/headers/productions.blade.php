<x-jet-nav-link href="{{ route('productions.index') }}" :active="request()->routeIs('productions.index')" class="text-lg">
    <i class="fas fa-table pr-1"></i> {{ __('Produtions list') }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('productions.create') }}" :active="request()->routeIs('productions.create')" class="text-lg">
    <i class="fas fa-plus pr-1"></i> {{ __('New production') }}
</x-jet-nav-link>

