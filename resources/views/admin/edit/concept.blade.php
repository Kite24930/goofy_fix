<x-app-layout>
    @vite('resources/css/content_edit.css')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('コンセプト編集') }}
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
        <div class="w-full max-w-md flex flex-col items-center">
            @foreach($concepts as $concept)
                <div class="input-{{ $concept->id }} bg-white border border-gray-200 rounded-xl m-2 p-4 max-w-md w-full">
                    <form action="{{ route('admin.update.concept', $concept->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center w-full">
                        @csrf
                        <img id="preview-img-{{ $concept->id }}" src="{{ asset('storage/'.$concept->concept_img) }}" alt="" class="max-w-sm max-h-[40vh]">
                        <label for="concept-img-{{ $concept->id }}" class="text-2xl font-bold">コンセプトイメージ</label>
                        <x-text-input id="concept-img-{{ $concept->id }}" type="file" name="concept_img" class="input-img" data-target="{{ $concept->id }}" :value="old('concept_img')" accept="image/jpeg, image/png" />
                        <label for="concept-title-{{ $concept->id }}" class="text-2xl font-bold">コンセプトタイトル</label>
                        <textarea name="concept_title" id="concept-title-{{ $concept->id }}" rows="3" class="w-full input-title" data-target="{{ $concept->id }}">{{ $concept->concept_title }}</textarea>
                        <label for="concept-text-{{ $concept->id }}" class="text-2xl font-bold">コンセプトテキスト</label>
                        <textarea name="concept_text" id="concept-text-{{ $concept->id }}" rows="3" class="w-full input-text" data-target="{{ $concept->id }}">{{ $concept->concept_text }}</textarea>
                        <x-primary-button class="mt-3">更新</x-primary-button>
                        <span>編集したら、下のプレビューで確認してください。</span>
                    </form>
                    <form id="delete-{{ $concept->id }}" action="{{ route('admin.destroy.concept', $concept->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-primary-button type="button" class="bg-red-600 mt-10 deleteBtn" data-target="{{ $concept->id }}">削除</x-primary-button>
                    </form>
                </div>
            @endforeach
            <x-primary-button id="addBtn" type="button">新規追加</x-primary-button>
            <div id="add" class="input-{{ count($concepts) + 1 }} bg-white border border-gray-200 rounded-xl m-2 p-4 max-w-md w-full hidden">
                <form action="{{ route('admin.update.concept', count($concepts) + 1) }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center w-full">
                    @csrf
                    <div class="text-4xl font-bold">新規追加</div>
                    <img id="preview-img-{{ count($concepts) + 1 }}" src="http://via.placeholder.com/350x450" alt="" class="max-w-sm max-h-[40vh]">
                    <label for="concept-img-{{ count($concepts) + 1 }}" class="text-2xl font-bold">コンセプトイメージ</label>
                    <x-text-input id="concept-img-{{ count($concepts) + 1 }}" type="file" name="concept_img" data-target="{{ count($concepts) + 1 }}" class="input-img" :value="old('concept_img')" required accept="image/jpeg, image/png" />
                    <label for="concept-title-{{ count($concepts) + 1 }}" class="text-2xl font-bold">コンセプトタイトル</label>
                    <textarea name="concept_title" id="concept-title-{{ count($concepts) + 1 }}" rows="3" class="w-full input-title" data-target="{{ count($concepts) + 1 }}"></textarea>
                    <label for="concept-text-{{ count($concepts) + 1 }}" class="text-2xl font-bold">コンセプトテキスト</label>
                    <textarea name="concept_text" id="concept-text-{{ count($concepts) + 1 }}" rows="3" class="w-full input-text" data-target="{{ count($concepts) + 1 }}"></textarea>
                    <x-primary-button class="mt-3">追加</x-primary-button>
                    <span>編集したら、下のプレビューで確認してください。</span>
                </form>
            </div>
        </div>
        <div class="text-2xl mt-6 border-t border-gray-400 w-full text-center">プレビュー</div>
        <div class="w-full flex flex-col justify-center items-center max-w-[1320px]">
            @foreach($concepts as $index => $concept)
                <div class="concept-{{ $concept->id }} p-12 flex flex-col justify-center items-center">
                    <div class="flex flex-col md:flex-row justify-center items-center">
                        @if($index % 2 === 0)
                            <div class="md:w-[40%] w-[80%] flex justify-center items-center">
                                <img src="{{ asset('storage/'.$concept->concept_img) }}" alt="" class="w-full image">
                            </div>
                            <div class="flex flex-col justify-center items-start">
                                <div class="text-[calc(1.375rem+1.5vw)] en-text text-goofy-color title">
                                    {!! nl2br(e($concept->concept_title)) !!}
                                </div>
                                <div class="ja text">
                                    {!! nl2br(e($concept->concept_text)) !!}
                                </div>
                            </div>
                        @else
                            <div class="md:w-[40%] w-[80%] md:hidden flex justify-center items-center">
                                <img src="{{ asset('storage/'.$concept->concept_img) }}" alt="" class="w-full image">
                            </div>
                            <div class="flex flex-col justify-center items-start">
                                <div class="text-[calc(1.375rem+1.5vw)] en-text text-goofy-color title">
                                    {!! nl2br(e($concept->concept_title)) !!}
                                </div>
                                <div class="ja text">
                                    {!! nl2br(e($concept->concept_text)) !!}
                                </div>
                            </div>
                            <div class="md:w-[40%] w-[80%] md:flex hidden justify-center items-center">
                                <img src="{{ asset('storage/'.$concept->concept_img) }}" alt="" class="w-full image">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="concept-{{ count($concepts) + 1 }} p-12 flex flex-col justify-center items-center">
                <div class="flex flex-col md:flex-row justify-center items-center">
                    @if(count($concepts) % 2 === 0)
                        <div class="md:w-[40%] w-[80%] flex justify-center items-center">
                            <img src="" alt="" class="w-full image">
                        </div>
                        <div class="flex flex-col justify-center items-start">
                            <div class="text-[calc(1.375rem+1.5vw)] en-text text-goofy-color title">

                            </div>
                            <div class="ja text">

                            </div>
                        </div>
                    @else
                        <div class="md:w-[40%] w-[80%] md:hidden flex justify-center items-center">
                            <img src="" alt="" class="w-full image">
                        </div>
                        <div class="flex flex-col justify-center items-start">
                            <div class="text-[calc(1.375rem+1.5vw)] en-text text-goofy-color title">

                            </div>
                            <div class="ja text">

                            </div>
                        </div>
                        <div class="md:w-[40%] w-[80%] md:flex hidden justify-center items-center">
                            <img src="" alt="" class="w-full image">
                        </div>
                    @endif
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
    @vite('resources/js/concept.js')
</x-app-layout>
