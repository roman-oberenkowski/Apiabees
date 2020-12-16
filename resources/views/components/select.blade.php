@props(['for', 'options'])

<select
    id="{{ $for }}"
    {!! $attributes->merge(['class' => 'mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5']) !!}
    >
    @foreach($options as $option)
        <option {{ $option['checked'] ? 'checked' : '' }} value="{{$option['value']}}">{{ $option['name'] }}</option>
    @endforeach
</select>
