<x-template title="Goofy Skate Park" css="index.css" :left="$left_links" :right="$right_links">
    <div class="position-relative">
        <ul id="slick" class="p-0">
            @for($i = 0; $i < $welcomes->top_img_count; $i++)
                <li><img src="{{ asset('storage/top_'.$i.'.jpg') }}" alt="TOP"></li>
            @endfor
        </ul>
        <div id="topNameWrapper" class="position-absolute top-50 translate-middle d-flex justify-content-center align-items-center">
            <span id="topName" class="typed text-white en-text"></span>
        </div>
    </div>
    <main class="container-fluid d-flex flex-column justify-content-center align-items-center m-0 p-0">
        <div id="concept" class="w-100 d-flex flex-column justify-content-center align-items-center">
            <div class="w-100 py-5 bg-goofy-color d-flex flex-column justify-content-center align-items-center position-relative">
                <img src="{{ asset('storage/rust_lt.png') }}" alt="" class="position-absolute top-0 start-0 h-60 z-index-100">
                <img src="{{ asset('storage/rust_rb.png') }}" alt="" class="position-absolute bottom-0 end-0 h-45 z-index-100">
                <div class="fs-0 w-100 text-center text-white en-text position-relative z-index-150">
                    {!! nl2br(e($welcomes->welcome_eng_msg)) !!}
                </div>
                <div class="fs-5 w-90 text-center text-white ja position-relative z-index-150">
                    {!! nl2br(e($welcomes->welcome_jp_msg)) !!}
                </div>
            </div>
            @foreach($concepts as $concept)
                @if($loop->index % 2 === 0)
                    <div class="container-md p-5 d-flex justify-content-center align-items-center">
                        <div class="d-flex flex-md-row flex-column justify-content-center align-items-center">
                            <div class="w-40 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('storage/'.$concept->concept_img) }}" alt="" class="w-100">
                            </div>
                            <div class="d-flex flex-column justify-content-center align-items-start">
                                <div class="fs-1 en-text text-goofy-color">
                                    {!! nl2br(e($concept->concept_title)) !!}
                                </div>
                                <div>
                                    {!! nl2br(e($concept->concept_text)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="container-md p-5 d-flex justify-content-center align-items-center">
                        <div class="d-flex flex-md-row flex-column justify-content-center align-items-center">
                            <div class="w-40 d-flex justify-content-center align-items-center d-md-none">
                                <img src="{{ asset('storage/'.$concept->concept_img) }}" alt="" class="w-100">
                            </div>
                            <div class="d-flex flex-column justify-content-center align-items-end pe-4">
                                <div class="fs-1 en-text text-goofy-color">
                                    {!! nl2br(e($concept->concept_title)) !!}
                                </div>
                                <div>
                                    {!! nl2br(e($concept->concept_text)) !!}
                                </div>
                            </div>
                            <div class="w-40 justify-content-center align-items-center d-md-block d-none">
                                <img src="{{ asset('storage/'.$concept->concept_img) }}" alt="" class="w-100">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div id="access" class="w-100 vhw-50 bg-goofy-color d-flex flex-md-row flex-column justify-content-end align-items-center">
            <div class="w-50 h-100 m-md-0  px-5 d-flex flex-column justify-content-center align-items-center bg-goofy-color text-white position-relative">
                <img src="{{ asset('storage/rust_rt.png') }}" alt="" class="position-absolute top-0 end-0 h-30 z-index-100">
                <div class="position-relative z-index-150 m-4">
                    <span class="fs-0 lh-1 en-text">
                    ACCESS
                    </span>
                    <div class="fs-5">
                        アクセス・駐車場
                    </div>
                    <div class="mt-4">
                        <span class="fs-5 en-text">Goofy Skate Park</span>
                        <br>
                        グーフィースケートパーク
                    </div>
                    @foreach($addresses as $address)
                        <div class="my-2">
                            <span class="en-text">[{{ $address->address_title }}]</span>
                            <div class="ms-3">
                                {!! nl2br(e($address->address_text)) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="map" class="w-50 h-100 m-0">

            </div>
        </div>
        <div id="price" class="w-100 vhw-50 bg-goofy-color d-flex flex-md-row flex-column justify-content-end align-items-center">
            <div class="w-50 h-100 m-0 d-md-block d-none">
                <img src="{{ asset('storage/park.jpg') }}" alt="" class="w-100 h-100">
            </div>
            <div class="w-50 h-100 m-md-0 px-5 d-flex flex-column justify-content-center align-items-center bg-goofy-color text-white position-relative">
                <img src="{{ asset('storage/rust_lt.png') }}" alt="" class="position-absolute top-0 start-0 h-30 z-index-100">
                <div class="m-4 position-relative z-index-150">
                    <span class="fs-0 lh-1 en-text">
                    PRICE
                    </span>
                    <div class="fs-5">
                        ご利用料金
                    </div>
                    <div class="mt-4 d-flex flex-column justify-content-center align-items-start">
                        @foreach($price_contents as $price_content)
                            <p class="fs-5 m-0">{{ $price_content->price_title }}</p>
                            <table class="my-2 ms-2">
                            @foreach($prices as $price)
                                @if($price->content_id === $price_content->id)
                                    <tr class="border-bottom">
                                        <td class="pe-3">{!! nl2br(e($price->price_content)) !!}</td>
                                        <td class="text-end">¥{{ number_format($price->price) }}-</td>
                                    </tr>
                                @endif
                            @endforeach
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-50 h-100 m-0 d-md-none">
                <img src="{{ asset('storage/park.jpg') }}" alt="" class="w-100 h-100">
            </div>
        </div>
        <div id="section" class="container-md mw-70 d-flex flex-column justify-content-center align-items-center">
            <div class="en-text fs-0 text-goofy-color">SECTION ITEMS</div>
            @if($coming_soon->section_item === 0)
                <div class="fs-1 en-text">COMING SOON</div>
            @else
                @foreach($sections as $section)
                    <div class="vh-30 w-100 label d-flex flex-md-row flex-column justify-content-center align-items-center">
                        <div class="w-50 h-100">
                            <img src="{{ asset('storage/'.$section->section_img) }}" alt="" class="h-100 w-100">
                        </div>
                        <div class="w-50 h-100 bg-goofy-color text-white en-text d-flex align-items-center justify-content-center fs-1">
                            {!! nl2br(e($section->section_title)) !!}
                        </div>
                    </div>
                    <ul class="d-flex flex-wrap section w-100 p-0">
                        @foreach($section_items as $section_item)
                            @if($section_item->section_id === $section->id)
                                <li class="d-flex flex-column justify-content-start align-items-center">
                                    <div class="position-relative square w-100">
                                        <img src="{{ asset('storage/'.$section_item->section_img) }}" alt="" class="position-absolute start-0 end-0 top-0 bottom-0 w-90 h-90 m-auto">
                                    </div>
                                    <div>{!! nl2br(e($section_item->section_content)) !!}</div>
                                </li>
                            @endif
                        @endforeach
                @endforeach
            @endif
        </div>
        <div id="school" class="w-100 vhw-50 d-flex flex-md-row flex-column justify-content-end align-items-center">
            <div class="w-50 h-100 m-0">
                <img src="{{ asset('storage/school_img.jpg') }}" alt="" class="w-100 h-100">
            </div>
            <div class="w-50 h-100 m-0 px-5 py-4 py-md-0 d-flex flex-column justify-content-center align-items-center text-white bg-black">
                <div class="w-80 d-flex flex-column justify-content-center align-items-center">
                    <div class="fs-0 en-text text-goofy-color">
                        SCHOOL
                    </div>
                    @if($coming_soon->school === 0)
                        <div class="fs-1 en-text">
                            COMING SOON
                        </div>
                        <div class="mt-4">
                            現在、調整中！！！
                            <br>
                            詳細が決まり次第、公開します。
                        </div>
                    @else
                        <div class="w-100">
                            グーフィースケートパーク外部講師が行う不定期スクールを開催しています。
                            <br>
                            スケジュールは、下記Instagramからご確認ください。
                        </div>
                        <div class="d-flex flex-md-row flex-column justify-content-between align-items-center w-100 my-4">
                            <div class="en-text w-50">
                                <span class="fs-5">INSTRUCTOR</span>
                                <br>
                                <span class="fs-2 text-goofy-color">JUNICHI ARAHATA</span>
                                <br>
                                プロスケートボーダー
                                <br>
                                1995 AJSA 全日本チャンピオン
                                <br>
                                スケートボードインストラクター
                                <br>
                                スケートボード解説者
                                <br>
                                JSF 公認ジャッジ
                            </div>
                            <div class="position-relative square w-40">
                                <img src="{{ asset('storage/instructor.jpg') }}" alt="" class="position-absolute w-95 h-95 top-50 start-50 translate-middle m-0">
                            </div>
                        </div>
                        <a href="#" class="w-100 text-decoration-none">
                            <div class="en-text fs-3 white-btn py-3 text-center">
                                <i class="bi bi-instagram"></i> JUNICHI ARAHATA - INSTAGRAM
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div id="food" class="w-100 bg-goofy-color d-flex flex-column justify-content-center align-items-center py-5">
            <div class="en-text fs-0 text-white">FOOD</div>
            <div class="w-70 d-flex flex-wrap justify-content-center align-items-center">
                @foreach($food as $menu)
                    <img src="{{ asset('storage/menu/'.$menu->food_img) }}" alt="menu" class="w-100 border my-3">
                @endforeach
            </div>
        </div>
        <div id="foodTruck" class="w-100 d-flex flex-column justify-content-center align-items-center">
            <div class="en-text fs-0 text-goofy-color">FOOD TRUCK</div>
            <div class="w-70 text-center">
                <img src="{{ asset('storage/'.$food_trucks->food_truck_img) }}" alt="" class="w-30">
            </div>
            <div id="foodTruckViewer">

            </div>
        </div>
        <div id="contact" class="w-100 bg-goofy-color d-flex flex-column justify-content-center align-items-center text-white py-5 position-relative">
            <img src="{{ asset('storage/rust_rt.png') }}" alt="" class="position-absolute top-0 end-0 h-30 z-index-100">
            <img src="{{ asset('storage/rust_lb.png') }}" alt="" class="position-absolute bottom-0 start-0 h-30 z-index-100">
            <div class="w-35 position-relative z-index-150">
                <div class="">
                    <span class="fs-0 en-text lh-1">CONTACT</span>
                    <br>
                    <span class="fs-4">お問い合わせ</span>
                </div>
                <div class="d-flex flex-column justify-content-between align-items-start">
                    <div class="p-3 w-100">
                        <a href="https://www.instagram.com/goofy_skatepark/" class="text-decoration-none"><div class="text-center px-5 py-3 fs-4 black-btn"><i class="bi bi-instagram"></i><span class="en-text">  GOOFY SKATE PARK INSTAGRAM</span></div></a>
                    </div>
                    <div class="p-3 w-100">
                        <a href="https://www.instagram.com/goofyburger/" class="text-decoration-none"><div class="text-center px-5 py-3 fs-4 black-btn"><i class="bi bi-instagram"></i><span class="en-text">  GOOFY BURGER INSTAGRAM</span></div></a>
                    </div>
                    <div class="p-3 w-100">
                        <a href="https://lin.ee/T6sAXnj" class="text-decoration-none"><div class="text-center px-5 py-3 fs-4 black-btn"><i class="bi bi-line"></i><span class="en-text">  GOOFY LINE</span></div></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="sponsor" class="container-md d-flex flex-column justify-content-center align-items-center">
            <div class="en-text fs-0 text-goofy-color">SPONSOR</div>
            @if($coming_soon->sponsor === 0)
                <div class="en-text fs-4">COMING SOON</div>
            @else
                <div class="d-flex flex-column flex-md-row justify-content-center align-items-center flex-wrap">
                    @foreach($sponsors as $sponsor)
                        <a href="{{ $sponsor->sponsor_url }}" class="m-2 px-3 py-2 sponsor text-center text-decoration-none">
                            {!! nl2br(e($sponsor->sponsor_name)) !!}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.welcomes = @json($welcomes);
        window.Laravel.concepts = @json($concepts);
        window.Laravel.addresses = @json($addresses);
        window.Laravel.prices = @json($prices);
        window.Laravel.price_contents = @json($price_contents);
        window.Laravel.sections = @json($sections);
        window.Laravel.section_items = @json($section_items);
        window.Laravel.schools = @json($schools);
        window.Laravel.food = @json($food);
        window.Laravel.food_trucks = @json($food_trucks);
        window.Laravel.contacts = @json($contacts);
        window.Laravel.contact_types = @json($contact_types);
        window.Laravel.sponsors = @json($sponsors);
        window.Laravel.left_links = @json($left_links);
        window.Laravel.right_links = @json($right_links);
        window.Laravel.coming_soon = @json($coming_soon);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/index.js'])
</x-template>
