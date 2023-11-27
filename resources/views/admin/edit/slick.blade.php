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
        <div>
            <span class="font-bold text-xl">順番の入れ替え</span>
            <br>
            入れ替えはドラッグ&ドロップで行います。
        </div>
        <ul id="slicks" class="w-3/4 max-w-sm">
            @for($i = 0; $i < $top_img_count; $i++)
                <li class="my-4">
                    <img src="{{ asset('storage/top_'.$i.'.jpg') }}" alt="{{ __('top_'.$i) }}" class="slick-img" data-order="{{ $i }}">
                </li>
            @endfor
        </ul>
        <x-primary-button id="sorting" type="button">
            並べ替え実行
        </x-primary-button>
        <div class="pt-6 mt-4 border-t w-3/4 max-w-sm">
            <div>
                <span class="font-bold text-xl">画像の削除</span>
            </div>
            <ul>
                @for($i = 0; $i < $top_img_count; $i++)
                    <li class="my-4">
                        <img src="{{ asset('storage/top_'.$i.'.jpg') }}" alt="{{ __('top_'.$i) }}" class="slick-img" data-order="{{ $i }}">
                        <x-primary-button type="button" class="delete-btn" data-target="{{ $i }}">
                            削除
                        </x-primary-button>
                    </li>
                @endfor
            </ul>
        </div>
        <div class="pt-6 mt-4 border-t w-3/4 max-w-sm">
            <div>
                <span class="font-bold text-xl">画像の追加</span>
            </div>
            <form action="{{ route('admin.update.slick') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="file" accept="image/jpeg, image/png" id="add_file" name="add_file">
                <img id="add_file_preview" src="http://via.placeholder.com/350x150" alt="preview">
                <x-primary-button class="my-2 mx-auto">
                    画像の追加
                </x-primary-button>
            </form>
        </div>
    </div>
    <script>
        window.Laravel = {};
        window.Laravel.success = @json(session('success'));
        window.Laravel.error = @json(session('error'));
        window.Laravel.errors = @json($errors->toArray());
        console.log(window.Laravel);
    </script>
    @vite('resources/js/slick.js')
</x-app-layout>
