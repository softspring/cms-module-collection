// core version + navigation, pagination modules:
// import Swiper, { Navigation, Pagination, Autoplay } from './swiper';
import Swiper from './swiper/swiper-bundle.esm.browser.min'
import './swiper/swiper-bundle.min.css'

import './_carousel.scss';

class Carousel {
    constructor() {
        this.swippers = [].slice.call(document.querySelectorAll('[data-swipper]'));
        if (!this.swippers.length) return;

        this.init();
    }

    async init() {
        const that = this;
        document.addEventListener("DOMContentLoaded", function() {
            that.swippers.forEach(function (swipper,i) {
                const slidesPerViewCarousel = (swipper.getAttribute('data-slides-per-view') == 'auto') ? 'auto' : parseInt(swipper.getAttribute('data-slides-per-view'));
                const autoplayCarousel = parseInt(swipper.getAttribute('data-autoplay'));
                const infiniteLoopCarousel = parseInt(swipper.getAttribute('data-infinite-loop'));
                const classSwiper = 'swiper-' + i;
                swipper.classList.add(classSwiper);

                // init Swiper:
                if(autoplayCarousel) {
                    const swiper = new Swiper('.'+ classSwiper, {
                        loop: infiniteLoopCarousel,
                        slidesPerView: slidesPerViewCarousel,
                        autoplay: {
                            delay: 3500,
                            disableOnInteraction: false,
                        },
                        // If we need pagination
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        // Navigation arrows
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                } else {
                    const swiper = new Swiper('.'+ classSwiper, {
                        // configure Swiper to use modules
                        // modules: [Navigation, Pagination],
                        loop: infiniteLoopCarousel,
                        slidesPerView: slidesPerViewCarousel,
                        // If we need pagination
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        // Navigation arrows
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                }

            });
        });
    }
}

export const carousel = new Carousel();
