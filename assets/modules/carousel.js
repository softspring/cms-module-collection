// import './swiper/swiper.scss';
// import './_carousel.scss';
// import Swiper from './swiper/core/core';
// import { Navigation, Pagination } from './swiper/swiper-bundle';

// core version + navigation, pagination modules:
import Swiper, { Navigation, Pagination, Autoplay } from './swiper';
// import Swiper and modules styles
import './swiper/swiper.scss';
import './swiper/modules/navigation/navigation.scss';
import './swiper/modules/pagination/pagination.scss';
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
                        // configure Swiper to use modules
                        modules: [Navigation, Pagination],
                        loop: infiniteLoopCarousel,
                        slidesPerView: slidesPerViewCarousel,
                        autoplay: {
                            delay: 2500,
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
                        modules: [Navigation, Pagination],
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
