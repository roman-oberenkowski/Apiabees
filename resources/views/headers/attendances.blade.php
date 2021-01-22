<x-jet-nav-link href="{{ route('attendances.index') }}" :active="request()->routeIs('attendances.index')" class="text-lg">
    <i class="fas fa-table pr-1"></i> {{ __('Attendance') }}
</x-jet-nav-link>

