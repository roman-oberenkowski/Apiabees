@props(['for'])

<div class="flex items-start">
    <div class="flex items-center h-5">
        <input id="{{ $for }}" type="checkbox"
            {!! $attributes->merge(['class' => 'form-checkbox h-4 w-4 text-yellow-400 transition duration-150 ease-in-out']) !!}>
    </div>
    <div class="ml-3 text-sm leading-5">
        <label for="{{ $for }}" class="font-medium text-gray-700">
        {{ $slot }}
        </label>
    </div>
</div>
