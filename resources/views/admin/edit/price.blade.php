<x-app-layout>
    @vite('resources/css/content_edit.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('アドレス編集') }}
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
        <div class="w-full flex flex-col items-center gap-6">
            <form action="{{ route('admin.update.price.content') }}" method="POST" class="flex flex-col items-start gap-4 bg-white rounded-xl p-4 border border-gray-200">
                @csrf
                <div class="text-xl font-bold">項目名</div>
                @foreach($price_contents as $price_content)
                    <div>
                        <input type="hidden" name="id[]" value="{{ $price_content->id }}">
                        {{ $price_content->id }}
                        <x-text-input name="price_title[{{ $price_content->id }}]" value="{{ $price_content->price_title }}" data-target="{{ $price_content->id }}" class="title" />
                        <x-primary-button class="bg-red-500 content-delete text-sm" type="button" data-url="{{ route('admin.destroy.price.content', $price_content->id) }}" data-csrf="{{ csrf_token() }}">削除</x-primary-button>
                    </div>
                @endforeach
                <x-primary-button id="contentAddBtn" type="button">新規追加</x-primary-button>
                <x-primary-button>更新</x-primary-button>
            </form>
            <form action="{{ route('admin.update.price') }}" method="POST" class="flex flex-col items-start gap-4 bg-white rounded-xl p-4 border border-gray-200 overflow-x-scroll">
                @csrf
                <div class="text-xl font-bold">料金項目</div>
                <form id="prices" class="w-full max-w-3xl">
                    @foreach($prices as $price)
                        <div class="m-2 p-2 border rounded-lg flex md:flex-row flex-col items-start justify-center gap-4">
                            <div>
                                <input type="hidden" name="id[]" value="{{ $price->id }}">
                                {{ $price->id }}
                                <select name="content_id[{{ $price->id }}]" id="" class="w-32 content_id">
                                    <option value="" class="hidden">項目を選択してください</option>
                                    @foreach($price_contents as $price_content)
                                        <option value="{{ $price_content->id }}" @if($price->content_id === $price_content->id) selected @endif>{{ $price_content->price_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-text-input name="price_content[{{ $price->id }}]" value="{{ $price->price_content }}" data-target="{{ $price->id }}" class="content" />
                                <x-text-input name="price[{{ $price->id }}]" value="{{ $price->price }}" data-target="{{ $price->id }}" class="price w-32" type="number" />
                            </div>
                            <x-primary-button class="bg-red-500 price-delete text-sm" type="button" data-url="{{ route('admin.destroy.price', $price->id) }}" data-csrf="{{ csrf_token() }}">削除</x-primary-button>
                        </div>
                    @endforeach
                    <x-primary-button id="priceAddBtn" type="button">新規追加</x-primary-button>
                    <x-primary-button>更新</x-primary-button>
                </form>
            </form>
        </div>
        <div class="text-2xl mt-6 border-t border-gray-400 w-full text-center">プレビュー</div>
        <div class="w-full md:h-[50vw] flex md:flex-row flex-col justify-center items-center">
            <div id="map" class="md:w-1/2 w-full md:h-full h-[100vw] m-0">
                <img src="{{ asset('storage/park.jpg') }}" alt="" class="w-full h-full object-cover">
            </div>
            <div class="md:w-1/2 w-full md:m-0 md:h-full h-auto flex flex-col justify-center items-center bg-goofy-color text-white px-12 relative">
                <img src="{{ asset('storage/rust_lt.png') }}" alt="" class="absolute top-0 start-0 h-[30%] z-10">
                <div id="preview" class="relative z-20 m-6">
                    <span class="text-[5rem] en-text">
                        PRICE
                    </span>
                    <div class="text-[1.25rem] ja">
                        ご利用料金
                    </div>
                    <div class="mt-6 flex flex-col justify-center items-start">
                        @foreach($price_contents as $price_content)
                            <p id="preview-title-{{ $price_content->id }}" class="text-[1.25rem] m-0 ja preview-title">{{ $price_content->price_title }}</p>
                            <table class="my-2 ml-2">
                                <tbody id="preview">
                                    @foreach($prices as $price)
                                        @if($price->content_id === $price_content->id)
                                            <tr class="border-b border-white ja">
                                                <td id="preview-content-{{ $price->id }}" class="pr-4 preview-content">{!! nl2br(e($price->price_content)) !!}</td>
                                                <td id="preview-price-{{ $price->id }}" class="text-right preview-price">¥{{ number_format($price->price) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.Laravel = {};
            window.Laravel.success = @json(session('success'));
            window.Laravel.error = @json(session('error'));
            window.Laravel.errors = @json($errors->toArray());
            window.Laravel.price_contents = @json($price_contents->toArray());
            window.Laravel.content_id_list = @json($price_contents->pluck('id')->toArray());
            window.Laravel.price_id_list = @json($prices->pluck('id')->toArray());
            console.log(window.Laravel);
        </script>
    @vite('resources/js/price.js')
</x-app-layout>
