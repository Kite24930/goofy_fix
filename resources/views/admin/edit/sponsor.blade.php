<x-app-layout>
    @vite('resources/css/content_edit.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('セクション編集') }}
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
        <div class="w-full flex flex-col items-center">
            <form>
                @csrf
                <label class="relative inline-flex items-center cursor-pointer">
                    <input id="publish-toggle" name="publish" type="checkbox" value="" class="sr-only peer" data-url="{{ route('sponsor.publish') }}" data-csrf="{{ csrf_token() }}" @if($coming_soons->sponsor === 1) checked @endif>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">公開設定</span>
                </label>
            </form>
        </div>
        <form action="{{ route('admin.update.sponsor') }}" method="POST" class="w-full" enctype="multipart/form-data">
            @csrf
            <ul id="sponsors" class="flex flex-wrap justify-center w-full">
                @foreach($sponsors as $sponsor)
                    <li class="flex flex-col p-4 bg-white m-4 rounded-lg gap-4 w-full max-w-sm">
                        <div>{{ $sponsor->id }}</div>
                        <input type="hidden" name="id[]" value="{{ $sponsor->id }}">
                        <label>
                            スポンサーロゴ
                            <br>
                            @if($sponsor->sponsor_logo)
                                <img id="sponsor-logo-{{ $sponsor->id }}" src="{{ asset('storage/sponsor/'.$sponsor->sponsor_logo) }}" alt="" class="h-[100px] w-auto object-contain logo-img">
                            @else
                                <img id="sponsor-logo-{{ $sponsor->id }}" src="http://via.placeholder.com/150x150" alt="" class="h-[100px] w-auto object-contain logo-img">
                            @endif
                            <input type="file" id="sponsor_logo-{{ $sponsor->id }}" name="sponsor_logo-{{ $sponsor->id }}" data-target="{{ $sponsor->id }}" class="logo" />
                        </label>
                        <label>
                            スポンサー名
                            <br>
                            <textarea name="sponsor_name[{{ $sponsor->id }}]" id="sponsor-name-{{ $sponsor->id }}" rows="2" class="w-full">{{ $sponsor->sponsor_name }}</textarea>
                        </label>
                        <label>
                            スポンサーURL
                            <br>
                            <x-text-input id="sponsor-url-{{ $sponsor->id }}" name="sponsor_url[{{ $sponsor->id }}]" value="{{ $sponsor->sponsor_url }}" class="w-full" />
                        </label>
                        <div class="text-center">
                            <x-primary-button class="bg-red-500 inline-block text-sm delete-btn" data-url="{{ route('admin.destroy.sponsor', $sponsor->id) }}" data-csrf="{{ csrf_token() }}" type="button">削除</x-primary-button>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-center gap-6">
                <x-primary-button id="addBtn" type="button">新規追加</x-primary-button>
                <x-primary-button>更新</x-primary-button>
            </div>
        </form>
        <div class="text-2xl mt-6 border-t border-gray-400 w-full text-center">プレビュー</div>
        <div class="w-full max-w-full flex flex-wrap justify-center items-center p-6 bg-white">
            @foreach($sponsors as $sponsor)
                @if($sponsor->sponsor_url)
                    <a href="{{ $sponsor->sponsor_url }}" class="m-2 py-2 px-4 text-center sponsor no-underline flex items-center">
                        @if($sponsor->sponsor_logo)
                            <div class="p-2 mr-2 rounded-r-full rounded-l-full bg-white">
                                <img id="preview-img-{{ $sponsor->id }}" src="{{ asset('storage/sponsor/'.$sponsor->sponsor_logo) }}" alt="" class="h-[45px] w-auto object-contain">
                            </div>
                        @endif
                        {!! nl2br(e($sponsor->sponsor_name)) !!}
                    </a>
                @else
                    <div class="m-2 py-2 px-4 text-center sponsor">
                        @if($sponsor->sponsor_logo)
                            <div class="p-2 mr-2 rounded-r-full rounded-l-full bg-white">
                                <img src="{{ asset('storage/sponsor/'.$sponsor->sponsor_logo) }}" alt="" class="h-[45px] w-auto object-contain">
                            </div>
                        @endif
                        {!! nl2br(e($sponsor->sponsor_name)) !!}
                    </div>
                @endif
            @endforeach
        </div>
        <script>
            window.Laravel = {};
            window.Laravel.success = @json(session('success'));
            window.Laravel.error = @json(session('error'));
            window.Laravel.errors = @json($errors->toArray());
            window.Laravel.sponsors = @json($sponsors);
            window.Laravel.id_list = @json($sponsors->pluck('id')->toArray());
            console.log(window.Laravel);
        </script>
    @vite('resources/js/sponsor.js')
</x-app-layout>
