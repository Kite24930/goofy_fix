import { Tooltip, Toast, Popover } from "bootstrap";
import $ from 'jquery';
import 'slick-carousel';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
import Typed from "typed.js";
import { Loader } from "@googlemaps/js-api-loader";
import { app, analytics } from "./firebase.js";

$('#slick').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    infinite: true,
    fade: true,
    cssEase: 'ease',
    arrows: false,
});

window.addEventListener('load', () => {
    let typed = new Typed('.typed', {
        strings: [
            'GOOFY SKATE PARK',
        ],
        typeSpeed: 50,
        startDelay: 500,
    });
    const loader = new Loader({
        apiKey: 'AIzaSyApdlkvbL5e3GeRiBRcdaQU3VsBpgHWClw',
        version: 'weekly',
        libraries: ['places'],
    });
    loader.load().then(() => {
        const park = new google.maps.LatLng(34.73433753865971, 136.47260968408696);
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: park,
            // gestureHandling: 'greedy',
        });
        const marker = new google.maps.Marker({
            position: park,
            icon: '/storage/goofy_pin.png',
        });
        marker.setMap(map);
    })
});

document.querySelectorAll('.scroll-btn').forEach(ele => {
    ele.addEventListener('click', e => {
        const targetID = e.target.getAttribute('data-bs-target');
        const target = document.getElementById(targetID);
        const rect = target.getBoundingClientRect();
        let offset;
        if ($(window).width() < 768) {
            offset = $(window).height() * 0.12;
        } else {
            offset = $(window).height() * 0.25;
        }
        const targetTop = rect.top + window.pageYOffset - offset;
        window.scrollTo({
            top: targetTop,
            behavior: 'smooth'
        })
    })
})
