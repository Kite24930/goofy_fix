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
        <div class="w-full flex flex-col items-center">
            <form action="{{ route('admin.update.address') }}" method="POST" class="w-full max-w-2xl">
                @csrf
                @foreach($addresses as $address)
                    <div class="bg-white p-4 rounded-xl m-4 border border-gray-200">
                        <input type="hidden" name="id_list[]" value="{{ $address->id }}">
                        <div class="flex md:flex-row flex-col justify-center items-center gap-4">
                            <div>
                                <label>
                                    項目名
                                    <br>
                                    <x-text-input id="title-{{ $address->id }}" name="sendData[{{ $address->id }}][title]" value="{{ $address->address_title }}" data-target="{{ $address->id }}" class="title" />
                                </label>
                            </div>
                            <div class="w-full max-w-md">
                                <label>
                                    内容
                                    <br>
                                    <textarea name="sendData[{{ $address->id }}][text]" id="text-{{ $address->id }}" rows="5" data-target="{{ $address->id }}" class="text w-full">{{ $address->address_text }}</textarea>
                                </label>
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <x-primary-button type="button" data-url="{{ route('admin.destroy.address', $address->id) }}" data-csrf="{{ csrf_token() }}" class="delete-btn bg-red-500">削除</x-primary-button>
                        </div>
                    </div>
                @endforeach
                <div id="addBtnArea" class="flex items-center justify-center">
                    <x-primary-button id="addBtn" type="button">新規追加</x-primary-button>
                </div>
                <div id="submitBtnArea" class="flex items-center justify-center mt-10 text-2xl">
                    <x-primary-button id="submitBtn">更新</x-primary-button>
                </div>
            </form>
        </div>
        <div class="text-2xl mt-6 border-t border-gray-400 w-full text-center">プレビュー</div>
        <div class="w-full md:h-[50vw] flex md:flex-row flex-col justify-center items-center">
            <div class="md:w-1/2 w-full md:m-0 md:h-full h-auto flex flex-col justify-center items-center bg-goofy-color text-white px-12 relative">
                <img src="{{ asset('storage/rust_rt.png') }}" alt="" class="absolute top-0 end-0 h-[30%] z-10">
                <div id="preview" class="relative z-20 m-6">
                    <span class="text-[5rem] en-text">
                        ACCESS
                    </span>
                    <div class="text-[1.25rem] ja">
                        アクセス・駐車場
                    </div>
                    <div class="mt-6 ja">
                        <span class="text-[1.25rem] en-text">Goofy Skate Park</span>
                        <br>
                        グーフィースケートパーク
                    </div>
                    @foreach($addresses as $address)
                        <div id="preview-{{ $address->id }}" class="my-2">
                            <span class="en-text">[{{ $address->address_title }}]</span>
                            <div class="ml-4 ja">
                                 {!! nl2br(e($address->address_text)) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="map" class="md:w-1/2 w-full md:h-full h-[100vw] m-0">

            </div>
        </div>
        <script>
            window.Laravel = {};
            window.Laravel.success = @json(session('success'));
            window.Laravel.error = @json(session('error'));
            window.Laravel.errors = @json($errors->toArray());
            window.Laravel.id_list = @json($addresses->pluck('id')->toArray());
            console.log(window.Laravel);
        </script>
    @vite('resources/js/address.js')
</x-app-layout>
