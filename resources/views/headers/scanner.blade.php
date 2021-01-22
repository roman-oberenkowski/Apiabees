<x-jet-nav-link href="{{ route('scanner.scan') }}" :active="request()->routeIs('scanner.scan')" class="text-lg">
    <i class="fas fa-qrcode pr-3"></i> {{ __('Scan') }}
</x-jet-nav-link>


