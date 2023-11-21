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
        <a href="/"><img src="{{ asset('storage/logo.png') }}" alt="Goofy Skate Park" class="logo"></a>
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
