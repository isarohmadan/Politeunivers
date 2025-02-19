document.addEventListener('DOMContentLoaded', function() {
    var swiper; // Define swiper variable

    function initSwiper() {
        // Destroy swiper instance if it exists
        if (swiper) swiper.destroy(true, true);

        // Reinitialize swiper with the correct slidesPerView
        swiper = new Swiper('.swiper', {
            slidesPerView: checkResolution(),
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 1500,
            },
        });

        swiper.on('transitionEnd', function () {
            let activeSlide = swiper.realIndex +1; // Index of Current active slide
            let previousSlide = swiper.previousIndex -2; // Index of previous active slide
            if (previousSlide == -1) { 
                previousSlide = 0;
            } else if (previousSlide == 
                document.querySelectorAll('.swiper-slide').length) { 
                // When swiper loops, slideChange 
                // gets fired twice and messes up animations. This 
                // prevents it from doing so.
              return;
            }
        });
    }

    // Function to check resolution and determine slidesPerView
    function checkResolution() {
        var slidesPerView = 4;
        if (window.innerWidth <= 1200 && window.innerWidth > 900) {
            slidesPerView = 3;
        }
        if (window.innerWidth <= 900 && window.innerWidth > 760) {
            slidesPerView = 2;
        }
        if (window.innerWidth <= 760) {
            slidesPerView = 1;
        }
        return slidesPerView;
    }

    // Initialize swiper on page load
    initSwiper();

    // Reinitialize swiper on window resize
    window.addEventListener('resize', function() {
        initSwiper();
    });
});
