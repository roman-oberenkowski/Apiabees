@props(['for'])

<div class="rounded-md shadow-sm">
    <textarea id="{{ $for }}" {!! $attributes->merge(['class' => 'form-textarea mt-1 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5']) !!}>{{ $slot }}</textarea>
</div>
@isset($subdescription)
<p class="mt-2 text-sm text-gray-500">{{ $subdescription }}</p>
@endif
