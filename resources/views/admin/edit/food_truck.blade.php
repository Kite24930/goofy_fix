<x-app-layout>
    @vite('resources/css/content_edit.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('フードトラック編集') }}
        </h2>
    </x-slot>

    <div class="w-full flex flex-col justify-center items-center pt-4 pb-10">
        @if (session('success'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ session('error') }}
        </div>
        @elseif($errors->count() > 0)
        <div class="mb-4 font-medium text-sm text-red-600">
            @foreach ($errors->all() as $error)
            {{ $error }}<br>
            @endforeach
        </div>
        @endif
        <form id="sendForm" action="{{ route('admin.update.food_truck') }}" method="POST" enctype="multipart/form-data" class="max-w-5xl w-full">
            @csrf
            <div class="flex flex-col justify-center items-center">
                <img id="food_truck-img" src="{{ asset('storage/'.$food_truck->food_truck_img) }}" alt="" class="w-full max-w-[500px]">
                <input id="food_truck_img" name="food_truck_img" type="file" class="my-4" accept="image/jpeg, image/png">
                <div id="editor" class="w-full">

                </div>
                <textarea name="food_truck_text" id="food_truck_text" class="hidden">{{ $food_truck->food_truck_text }}</textarea>
            </div>
            <div class="flex justify-center items-center m-6 gap-6">
                <x-primary-button>更新</x-primary-button>
            </div>
        </form>
        <div class="text-2xl mt-6">プレビュー</div>
        <div class="w-[70%] py-12 flex flex-col justify-center items-center relative bg-white">
            <img id="preview_img" src="{{ asset('storage/'.$food_truck->food_truck_img) }}" alt="" class="w-full max-w-[500px]">
            <div id="viewer" class="w-full flex flex-col items-center text-center">

            </div>
        </div>
    </div>
    <script>
        window.Laravel = {};
        window.Laravel.success = @json(session('success'));
        window.Laravel.error = @json(session('error'));
        window.Laravel.errors = @json($errors->toArray());
        window.Laravel.food_truck = @json($food_truck);
        console.log(window.Laravel);
    </script>
    @vite('resources/js/food_truck.js')
</x-app-layout>
