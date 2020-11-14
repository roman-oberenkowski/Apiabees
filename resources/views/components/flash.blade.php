@if ($message = Session::get('success'))
<div class="flash max-w-7xl mx-auto sm:px-6 lg:px-8 top-0 right-0 m-6">
    <div  class="bg-green-200 text-green-900 rounded-lg shadow-md p-6 pr-10 flex justify-between">
        <div class="flex items-center">
            {{ $message }}
        </div>
        <button  class="opacity-75 cursor-pointer top-0 right-0 py-2 px-3 hover:opacity-100 close-flash" > <i class="fas fa-times"></i> </button>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
    <div class="flash max-w-7xl mx-auto sm:px-6 lg:px-8 top-0 right-0 m-6">
        <div  class="bg-red-200 text-red-900 rounded-lg shadow-md p-6 pr-10 flex justify-between">
            <div class="flex items-center">
                {{ $message }}
                @if ($errors->any())
                    <div {{ $attributes }}>
                        <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <button  class="opacity-75 cursor-pointer top-0 right-0 py-2 px-3 hover:opacity-100 close-flash" > <i class="fas fa-times"></i> </button>
        </div>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="flash max-w-7xl mx-auto sm:px-6 lg:px-8 top-0 right-0 m-6">
        <div  class="bg-yellow-200 text-yellow-900 rounded-lg shadow-md p-6 pr-10 flex justify-between">
            <div class="flex items-center">
                {{ $message }}
            </div>
            <button  class="opacity-75 cursor-pointer top-0 right-0 py-2 px-3 hover:opacity-100 close-flash" > <i class="fas fa-times"></i> </button>
        </div>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="flash max-w-7xl mx-auto sm:px-6 lg:px-8 top-0 right-0 m-6">
        <div  class="bg-blue-200 text-blue-900 rounded-lg shadow-md p-6 pr-10 flex justify-between">
            <div class="flex items-center">
                {{ $message }}
            </div>
            <button  class="opacity-75 cursor-pointer top-0 right-0 py-2 px-3 hover:opacity-100 close-flash" > <i class="fas fa-times"></i> </button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="flash max-w-7xl mx-auto sm:px-6 lg:px-8 top-0 right-0 m-6">
        <div  class="bg-grey-200 text-grey-900 rounded-lg shadow-md p-6 pr-10 flex justify-between">
            <div class="flex items-center">
                {{ $message }}
            </div>
            <button  class="opacity-75 cursor-pointer top-0 right-0 py-2 px-3 hover:opacity-100 close-flash" > <i class="fas fa-times"></i> </button>
        </div>
    </div>
@endif
