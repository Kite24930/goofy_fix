<!DOCTYPE html>
<html lang="ja">
<x-head title="編集ページ">
    @vite(['resources/css/edit.css'])
</x-head>
<body>
<div id="editHeader" class="d-flex justify-content-center align-items-center fs-3">
    編集画面
</div>
<div id="container">
    <header class="position-fixed top-0 start-0 w-100 bg-white z-index-160">
        <img src="{{ asset('storage/rust_lt.png') }}" alt="" class="position-absolute top-0 start-0 h-60 z-index-170">
        <img src="{{ asset('storage/rust_rb.png') }}" alt="" class="position-absolute bottom-0 end-0 h-60 z-index-170">
        <div class="h-100 d-flex justify-content-between align-content-center">
            <div class="d-flex justify-content-md-center justify-content-start align-items-center mx-md-5 mx-3 fs-3">
                <div class="d-none d-md-flex justify-content-center align-items-center mx-5 fs-3">
                    <div class="dropdown me-3">
                        <a href="#" class="sns-button" role="button" id="instagramDrop" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-instagram"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="instagramDrop">
                            <li><a class="dropdown-item" href="https://www.instagram.com/goofy_skatepark/"><span class="en-text">Goofy Skate Park Instagram</span></a></li>
                            <li><a class="dropdown-item" href="https://www.instagram.com/goofyburger/"><span class="en-text">Goofy Burger Instagram</span></a></li>
                        </ul>
                    </div>
                    <a href="https://www.threads.net/@goofyburger" class="me-3 sns-button d-flex justify-content-center align-items-center" style="height: 42px"><img src="{{ asset('storage/threads.png') }}" alt="threads" style="height: 28px; width: auto;"></a>
                    <a href="https://lin.ee/T6sAXnj" class="me-3 sns-button"><i class="bi bi-line"></i></a>
                    <a href="https://www.youtube.com/@goofyburger_skate" class="me-3 sns-button"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.tiktok.com/@goofyburger.mie" class="me-3 sns-button"><i class="bi bi-tiktok"></i></a>
                    <a href="https://twitter.com/goofyburger_" class="me-3 sns-button"><i class="bi bi-twitter"></i></a>
                </div>
                <div class="d-flex d-md-none justify-content-center align-items-center mx-3 fs-3">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle position-relative z-index-180" role="button" id="snsDrop" data-bs-toggle="dropdown" aria-expanded="false"><span class="en-text">SNS</span></a>
                        <ul class="dropdown-menu" aria-labelledby="snsDrop">
                            <li><a class="dropdown-item" href="https://www.instagram.com/goofy_skatepark/"><i class="bi bi-instagram"></i><span class="en-text">Goofy Skate Park</span></a></li>
                            <li><a class="dropdown-item" href="https://www.instagram.com/goofyburger/"><i class="bi bi-instagram"></i><span class="en-text">Goofy Burger</span></a></li>
                            <li><a class="dropdown-item d-flex align-items-center" href="https://www.threads.net/@goofyburger"><img src="{{ asset('storage/threads.png') }}" alt="threads" style="height: 16px; width: auto;"><span class="en-text">Goofy Burger</span></a></li>
                            <li><a class="dropdown-item" href="https://lin.ee/T6sAXnj"><i class="bi bi-line"></i><span class="en-text">LINE</span></a></li>
                            <li><a class="dropdown-item" href="https://www.youtube.com/@goofyburger_skate"><i class="bi bi-youtube"></i><span class="en-text">YouTube</span></a></li>
                            <li><a class="dropdown-item" href="https://www.tiktok.com/@goofyburger.mie"><i class="bi bi-tiktok"></i><span class="en-text">TikTok</span></a></li>
                            <li><a class="dropdown-item" href="https://twitter.com/goofyburger_"><i class="bi bi-twitter"></i><span class="en-text">Twitter</span></a></li>
                            {{--                        <li><a class="dropdown-item" href="#"><i class="bi bi-shop"></i><span class="en-text">SHOP</span></a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            {{--        <div class="d-none d-md-flex justify-content-center align-items-center mx-5 px-5 fs-1">--}}
            {{--            <a href="#" class="sns-button position-relative z-index-180"><i class="bi bi-shop"></i></a>--}}
            {{--        </div>--}}
            <div class="d-flex justify-content-center align-items-center d-md-none dropdown">
                <a href="#" class="dropdown-toggle fs-1 me-4 position-relative z-index-180" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-list"></i></a>
                <ul class="dropdown-menu en-text" aria-labelledby="dropdownMenuLink">
                    <li data-bs-target="concept" class="m-3 dropdown-item scroll-btn">CONCEPT</li>
                    <li data-bs-target="access" class="m-3 dropdown-item scroll-btn">ACCESS</li>
                    <li data-bs-target="price" class="m-3 dropdown-item scroll-btn">PRICE</li>
                    <li data-bs-target="section" class="m-3 dropdown-item scroll-btn">SECTION</li>
                    <li data-bs-target="school" class="m-3 dropdown-item scroll-btn">SCHOOL</li>
                    <li data-bs-target="food" class="m-3 dropdown-item scroll-btn">FOOD</li>
                    <li data-bs-target="foodTruck" class="m-3 dropdown-item scroll-btn">FOOD TRUCK</li>
                    <li data-bs-target="contact" class="m-3 dropdown-item scroll-btn">CONTACT</li>
                </ul>
            </div>
        </div>
        <div id="header-center" class="position-absolute d-flex flex-column align-items-center top-0 start-50 translate-middle-x">
            <div class="position-relative">
                <a href="{{ route('admin.edit.header_logo') }}" class="edit-panel" data-target="header_logo"><i class="bi bi-pencil-square"></i></a>
                <img src="{{ asset('storage/logo.png') }}" alt="Goofy Skate Park" class="logo">
            </div>
            <div class="d-none d-md-flex en-text under-area align-items-center justify-content-center">
                <div data-bs-target="concept" class="px-3 py-2 scroll-btn">CONCEPT</div>
                <div data-bs-target="access" class="px-3 py-2 scroll-btn">ACCESS</div>
                <div data-bs-target="price" class="px-3 py-2 scroll-btn">PRICE</div>
                <div data-bs-target="section" class="px-3 py-2 scroll-btn">SECTION</div>
                <div data-bs-target="school" class="px-3 py-2 scroll-btn">SCHOOL</div>
                <div data-bs-target="food" class="px-3 py-2 scroll-btn">FOOD</div>
                <div data-bs-target="foodTruck" class="px-3 py-2 scroll-btn">FOOD TRUCK</div>
                <div data-bs-target="contact" class="px-3 py-2 scroll-btn">CONTACT</div>
            </div>
        </div>
    </header>
    <main>
        <div class="position-relative">
            <div class="position-relative">
                <a href="{{ route('admin.edit.slick') }}" class="edit-panel" data-target="slick_img"><i class="bi bi-pencil-square"></i></a>
                <ul id="slick" class="p-0">
                    @for($i = 0; $i < $welcomes->top_img_count; $i++)
                        <li><img src="{{ asset('storage/top_'.$i.'.jpg') }}" alt="TOP"></li>
                    @endfor
                </ul>
            </div>
            <div id="topNameWrapper" class="position-absolute top-50 translate-middle d-flex justify-content-center align-items-center">
                <span id="topName" class="typed text-white en-text"></span>
            </div>
        </div>
        <main class="container-fluid d-flex flex-column justify-content-center align-items-center m-0 p-0">
            <div id="concept" class="w-100 d-flex flex-column justify-content-center align-items-center">
                <div class="w-100 py-5 bg-goofy-color d-flex flex-column justify-content-center align-items-center position-relative">
                    <img src="{{ asset('storage/rust_lt.png') }}" alt="" class="position-absolute top-0 start-0 h-60 z-index-100">
                    <img src="{{ asset('storage/rust_rb.png') }}" alt="" class="position-absolute bottom-0 end-0 h-45 z-index-100">
                    <div class="position-relative">
                        <a href="{{ route('admin.edit.welcome') }}" class="edit-panel" data-target="welcome_msg"><i class="bi bi-pencil-square"></i></a>
                        <div class="fs-0 w-100 text-center text-white en-text position-relative z-index-150">
                            {!! nl2br(e($welcomes->welcome_eng_msg)) !!}
                        </div>
                        <div class="fs-5 w-90 text-center text-white ja position-relative z-index-150">
                            {!! nl2br(e($welcomes->welcome_jp_msg)) !!}
                        </div>
                    </div>
                </div>
                <div class="position-relative">
                    <a href="{{ route('admin.edit.concept') }}" class="edit-panel" data-target="concepts"><i class="bi bi-pencil-square"></i></a>
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
                        <div class="position-relative">
                            <a href="{{ route('admin.edit.address') }}" class="edit-panel" data-target="addresses"><i class="bi bi-pencil-square"></i></a>
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
                        <div class="mt-4 d-flex flex-column justify-content-center align-items-start position-relative">
                            <a href="{{ route('admin.edit.price') }}" class="edit-panel" data-target="welcome_eng_msg"><i class="bi bi-pencil-square"></i></a>
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
            <div id="section" class="container-md mw-70 d-flex flex-column justify-content-center align-items-center position-relative">
                <div class="en-text fs-0 text-goofy-color">SECTION ITEMS</div>
                <div class="position-relative">
                    <a href="{{ route('admin.edit.section') }}" class="edit-panel" data-target="sections"><i class="bi bi-pencil-square"></i></a>
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
                <div class="w-70 d-flex flex-wrap justify-content-center align-items-center position-relative">
                    <a href="{{ route('admin.edit.food') }}" class="edit-panel" data-target="food"><i class="bi bi-pencil-square"></i></a>
                    @foreach($food as $menu)
                        <img src="{{ asset('storage/menu/'.$menu->food_img) }}" alt="menu" class="w-100 border my-3">
                    @endforeach
                </div>
            </div>
            <div id="foodTruck" class="w-100 d-flex flex-column justify-content-center align-items-center">
                <div class="en-text fs-0 text-goofy-color">FOOD TRUCK</div>
                <div class="position-relative d-flex flex-column justify-content-center align-items-center">
                    <a href="{{ route('admin.edit.food_truck') }}" class="edit-panel" data-target="food_trucks"><i class="bi bi-pencil-square"></i></a>
                    <div class="w-70 text-center">
                        <img src="{{ asset('storage/'.$food_truck->food_truck_img) }}" alt="" class="container-sm top-img">
                    </div>
                    <div id="foodTruckViewer" class="w-full flex flex-col items-center text-center">

                    </div>
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
                <div class="position-relative">
                    <a href="{{ route('admin.edit.sponsor') }}" class="edit-panel" data-target="sponsor"><i class="bi bi-pencil-square"></i></a>
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
            window.Laravel.food_truck = @json($food_truck);
            window.Laravel.contacts = @json($contacts);
            window.Laravel.contact_types = @json($contact_types);
            window.Laravel.sponsors = @json($sponsors);
            window.Laravel.left_links = @json($left_links);
            window.Laravel.right_links = @json($right_links);
            window.Laravel.coming_soon = @json($coming_soon);
            console.log(window.Laravel);
        </script>
    </main>
    <x-footer></x-footer>
</div>
@vite(['resources/js/edit.js'])
</body>
</html>
