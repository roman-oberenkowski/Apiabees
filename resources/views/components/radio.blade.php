@props(['for'])

<div class="flex items-center mt-3">
    <input id="{{ $for }}" type="radio"
           {!! $attributes->merge(['class' => 'form-radio h-4 w-4 text-yellow-400 transition duration-150 ease-in-out']) !!}>
    <label for="{{ $for }}" class="ml-3">
        {{ $slot }}
    </label>
</div>

