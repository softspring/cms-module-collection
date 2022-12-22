// import './swiper/swiper.scss';
// import './_carousel.scss';
// import Swiper from './swiper/core/core';
// import { Navigation, Pagination } from './swiper/swiper-bundle';

// core version + navigation, pagination modules:
import Swiper, { Navigation, Pagination } from './swiper';
// import Swiper and modules styles
import './swiper/swiper.scss';
import './swiper/modules/navigation/navigation.scss';
import './swiper/modules/pagination/pagination.scss';
import './_carousel.scss';

class Carousel {
    constructor() {
        this.init();
    }

    async init() {
        document.addEventListener("DOMContentLoaded", function() {
            // init Swiper:
            const swiper = new Swiper('.swiper', {
                // configure Swiper to use modules
                modules: [Navigation, Pagination],
                loop: true,
                slidesPerView: window.slidesPerViewCaousel,
                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },
                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    }
}

export const carousel = new Carousel();
