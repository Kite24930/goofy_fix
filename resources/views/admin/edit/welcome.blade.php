<x-app-layout>
    @vite('resources/css/content_edit.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WELCOME メッセージ編集') }}
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
        <div class="w-full max-w-md">
            <form action="{{ route('admin.update.welcome') }}" method="POST" class="flex flex-col w-full p-4">
                @csrf
                <label for="welcome_eng_msg">英語メッセージ部</label>
                <textarea name="welcome_eng_msg" id="welcome_eng_msg" rows="3" class="w-full input" data-preview="eng_msg_preview" required>{{ $welcomes->welcome_eng_msg }}</textarea>
                <label for="welcome_jp_msg">日本語メッセージ部</label>
                <textarea name="welcome_jp_msg" id="welcome_jp_msg" rows="3" class="w-full input" data-preview="jp_msg_preview" required>{{ $welcomes->welcome_jp_msg }}</textarea>
                <x-primary-button class="mt-4 justify-center">更新</x-primary-button>
                <span>文章を入力すると↓のプレビューに文章が反映されます。</span>
            </form>
        </div>
        <div class="text-2xl mt-6">プレビュー</div>
        <div class="w-full py-12 flex flex-col justify-center items-center relative bg-goofy-color">
            <img src="{{ asset('storage/rust_lt.png') }}" alt="" class="absolute top-0 start-0 h-[60%]">
            <img src="{{ asset('storage/rust_rb.png') }}" alt="" class="absolute bottom-0 end-0 h-[60%]">
            <div id="eng_msg_preview" class="md:text-[5rem] text-[2rem] en-text text-white text-center">
                {!! nl2br(e($welcomes->welcome_eng_msg)) !!}
            </div>
            <div id="jp_msg_preview" class="md:text-[1.25rem] text-[1rem] ja text-white text-center">
                {!! nl2br(e($welcomes->welcome_jp_msg)) !!}
            </div>
        </div>
    </div>
    <script>
        window.Laravel = {};
        window.Laravel.success = @json(session('success'));
        window.Laravel.error = @json(session('error'));
        window.Laravel.errors = @json($errors->toArray());
        console.log(window.Laravel);
    </script>
    @vite('resources/js/welcome.js')
</x-app-layout>
