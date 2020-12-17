<div x-data="{ delayed : 0 }" x-init="requestAnimationFrame(() => delayed = 1)">
    <template x-if="delayed">
        {{ $slot }}
    </template>
</div>
