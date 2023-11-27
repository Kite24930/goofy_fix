<x-app-layout>
    @vite('resources/css/content_edit.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ヘッダーロゴ編集') }}
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
        <div class="w-[75dvw] max-w-[200px]">
            <div class="relative square w-100 bg-white">
                <img src="{{ asset('storage/logo.png') }}" alt="logo" class="absolute top-0 bottom-0 right-0 left-0">
            </div>
        </div>
        <div class="my-4">
            <i class="bi bi-arrow-down-square-fill text-5xl"></i>
        </div>
        <div class="w-[75dvw] max-w-[200px] text-center">
            <form action="{{ route('admin.update.header_logo') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input id="header_logo" name="header_logo" type="file" class="mb-4" accept="image/jpeg, image/png" />
                <div class="relative square w-100 bg-white">
                    <img id="updateImg" src="http://via.placeholder.com/200x200?text=not selected" alt="logo" class="absolute top-0 bottom-0 right-0 left-0">
                </div>
                <x-primary-button class="text-xl my-4">
                    更新
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
    @vite('resources/js/headerLogo.js')
</x-app-layout>
