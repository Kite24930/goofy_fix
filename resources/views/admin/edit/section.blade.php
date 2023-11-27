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
                    <input id="publish-toggle" name="publish" type="checkbox" value="" class="sr-only peer" data-url="{{ route('section.publish') }}" data-csrf="{{ csrf_token() }}" @if($coming_soons->section_item === 1) checked @endif>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">公開設定</span>
                </label>
            </form>
            <p class="text-3xl font-bold">エリア設定</p>
            <div class="w-full max-w-xl p-4 bg-white rounded-lg border flex flex-col items-center">
                @foreach($sections as $section)
                    <form action="{{ route('admin.update.section', $section->id) }}" method="POST" enctype="multipart/form-data"  class="bg-white border border-gray-500 rounded m-2 p-2">
                        @csrf
                        <label>
                            {{ $section->id }}
                            <x-text-input id="section-{{ $section->id }}" name="section_title" value="{{ $section->section_title }}" class="section-title" data-target="{{ $section->id }}" />
                        </label>
                        <img id="section-img-{{ $section->id }}" src="{{ asset('storage/'.$section->section_img) }}" alt="" class="max-w-sm my-2 object-cover">
                        <x-text-input id="section-img-{{ $section->id }}" name="section_img" data-target="{{ $section->id }}" type="file" accept="image/jpeg, image/png" class="section-img" />
                        <div class="flex justify-evenly py-2">
                            <x-primary-button>エリア更新</x-primary-button>
                            <x-primary-button type="button" data-url="{{ route('admin.destroy.section', $section->id) }}" data-csrf="{{ csrf_token() }}" class="bg-red-500 section-delete">削除</x-primary-button>
                        </div>
                    </form>
                @endforeach
                <form id="addForm" action="{{ route('admin.update.section', max($section->pluck('id')->toArray()) + 1) }}" method="POST" enctype="multipart/form-data"  class="hidden bg-white border border-gray-500 rounded m-2 p-2">
                    @csrf
                    <label>
                        {{ max($section->pluck('id')->toArray()) + 1 }}
                        <x-text-input id="section-{{ max($section->pluck('id')->toArray()) + 1 }}" name="section_title" value="" />
                    </label>
                    <img id="section-img-{{ max($section->pluck('id')->toArray()) + 1 }}" src="" alt="" class="max-w-sm my-2 object-cover">
                    <x-text-input id="section-img-{{ max($section->pluck('id')->toArray()) + 1 }}" name="section_img" data-target="{{ max($section->pluck('id')->toArray()) + 1 }}" type="file" accept="image/jpeg, image/png" class="section-img" />
                    <div class="flex justify-evenly py-2">
                        <x-primary-button>追加</x-primary-button>
                    </div>
                </form>
                <x-primary-button id="addBtn" type="button">新規追加</x-primary-button>
            </div>
            <p class="text-3xl font-bold border-t mt-6 w-full border-gray-500 text-center">アイテム設定</p>
            <form id="itemForm" action="{{ route('admin.update.section.item') }}" method="POST" enctype="multipart/form-data" class="w-full flex justify-center items-center flex-col">
                @csrf
                <div>ドラッグで並べ替えができます。</div>
                <ul id="items" class="w-full bg-white rounded-lg border flex md:flex-row flex-col items-center justify-center gap-6 flex-wrap">
                    @foreach($section_items as $index => $section_item)
                        <li class="p-4 bg-white border border-gray-500 rounded flex flex-col items-center" data-order="{{ $index }}">
                            <div>{{ $section_item->id }}</div>
                            <input type="hidden" name="id[]" value="{{ $section_item->id }}">
                            <select name="section_id[{{ $section_item->id }}]" id="">
                                <option value="" class="hidden">セクションを選択してください。</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}" @if($section->id === $section_item->section_id) selected @endif>{{ $section->section_title }}</option>
                                @endforeach
                            </select>
                            <div class="square relative w-1/2 max-w-sm">
                                <img id="item-img-{{ $section_item->id }}" src="{{ asset('storage/'.$section_item->section_img) }}" alt="" class="absolute start-0 end-0 top-0 bottom-0 w-[90%] h-[90%] m-auto object-cover">
                            </div>
                            <x-text-input name="section_img-{{ $section_item->id }}" type="file" accept="image/jpeg, image/png" class="item-img" data-target="{{ $section_item->id }}" />
                            <div>
                                <label>
                                    アイテム名：
                                    <x-text-input name="section_content[{{ $section_item->id }}]" value="{{ $section_item->section_content }}" class="item-content" data-target="{{ $section_item->id }}" />
                                </label>
                            </div>
                            <div>
                                <x-primary-button class="item-delete bg-red-500" data-url="{{ route('admin.destroy.section.item', $section_item->id) }}" data-csrf="{{ csrf_token() }}" type="button">削除</x-primary-button>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <x-primary-button id="itemAddBtn" type="button" class="my-4">新規追加</x-primary-button>
                <x-primary-button id="itemSubmit">アイテム更新</x-primary-button>
            </form>
        </div>
        <div class="text-2xl mt-6 border-t border-gray-400 w-full text-center">プレビュー</div>
        <div class="w-full md:max-w-[70vw] max-w-full flex flex-col justify-center items-center p-4">
            @foreach($sections as $section)
                <div class="h-[30vh] w-full flex md:flex-row flex-col justify-center items-center ">
                    <div class="md:w-1/2 w-full md:h-full h-1/2">
                        <img id="preview-img-{{ $section->id }}" src="{{ asset('storage/'.$section->section_img) }}" alt="" class="h-full w-full object-cover">
                    </div>
                    <div id="preview-title-{{ $section->id }}" class="md:w-1/2 w-full md:h-full h-1/2 bg-goofy-color text-white en-text flex items-center justify-center text-[calc(1.375rem+1.5vw)]">
                        {!! nl2br(e($section->section_title)) !!}
                    </div>
                </div>
                <ul class="flex flex-wrap w-full p-0">
                    @foreach($section_items as $section_item)
                        @if($section_item->section_id === $section->id)
                            <li class="flex flex-col justify-start items-center md:w-1/3 w-1/2 list-none">
                                <div class="relative square w-full">
                                    <img id="preview-item-{{ $section_item->id }}" src="{{ asset('storage/'.$section_item->section_img) }}" alt="" class="absolute start-0 end-0 top-0 bottom-0 w-[90%] h-[90%] m-auto object-cover">
                                </div>
                                <div id="preview-content-{{ $section_item->id }}">
                                    {!! nl2br(e($section_item->section_content)) !!}
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endforeach
        </div>
        <script>
            window.Laravel = {};
            window.Laravel.success = @json(session('success'));
            window.Laravel.error = @json(session('error'));
            window.Laravel.errors = @json($errors->toArray());
            window.Laravel.sections = @json($sections);
            window.Laravel.section_items = @json($section_items);
            window.Laravel.id_list = @json($section_items->pluck('id')->toArray());
            console.log(window.Laravel);
        </script>
    @vite('resources/js/section.js')
</x-app-layout>
