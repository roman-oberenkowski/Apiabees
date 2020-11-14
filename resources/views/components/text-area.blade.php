@props(['id', 'placeholder', 'subdescription' => '', 'rows' => 3])

<label for="{{ $id }}" class="block text-sm leading-5 font-medium text-gray-700">{{ $slot }}</label>
<div class="rounded-md shadow-sm">
    <textarea id="{{ $id }}" rows="{{ $rows }}" name="{{ $id }}" @isset($value) value="{{ $value }}" @endisset class="form-textarea mt-1 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="{{ $placeholder }}"></textarea>
</div>
@if($subdescription !== '')
<p class="mt-2 text-sm text-gray-500">{{ $subdescription }}</p>
@endif
