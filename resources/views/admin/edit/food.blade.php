<x-app-layout>
    @vite('resources/css/content_edit.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('キャッチイメージ編集') }}
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
        <div class="text-3xl font-bold">
            メニュー編集
        </div>
        <form action="{{ route('admin.update.food') }}" method="POST" enctype="multipart/form-data" class="">
            @csrf
            <ul id="menus" class="flex md:flex-row flex-col justify-center items-center w-full flex-wrap gap-6">
                @foreach($food as $item)
                    <li class="md:max-w-sm max-w-[50vw]">
                        <div>{{ $item->id }}</div>
                        <input type="hidden" name="id[]" value="{{ $item->id }}">
                        <img id="preview-{{ $item->id }}" src="{{ asset('storage/menu/'.$item->food_img) }}" alt="" class="preview-{{ $item->id }}">
                        <input id="img-{{ $item->id }}" type="file" name="food_img-{{ $item->id }}" data-target="{{ $item->id }}" class="food-img" accept="image/jpeg, image/png">
                        <x-primary-button type="button" class="bg-red-500 delete-btn" data-url="{{ route('admin.destroy.food', $item->id) }}" data-csrf="{{ csrf_token() }}">削除</x-primary-button>
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-center items-center m-6 gap-6">
                <x-primary-button type="button" id="addBtn">新規追加</x-primary-button>
                <x-primary-button>更新</x-primary-button>
            </div>
        </form>
    </div>
    <script>
        window.Laravel = {};
        window.Laravel.success = @json(session('success'));
        window.Laravel.error = @json(session('error'));
        window.Laravel.errors = @json($errors->toArray());
        window.Laravel.food = @json($food);
        window.Laravel.id_list = @json($food->pluck('id')->toArray());
        console.log(window.Laravel);
    </script>
    @vite('resources/js/food.js')
</x-app-layout>
