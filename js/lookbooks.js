document.addEventListener('DOMContentLoaded', function() {

    // check is there class named swiper
        function initSwiper() {
          // Destroy swiper instance if it exists
          // if (swiper) swiper.destroy(true, true);


          // Reinitialize swiper with the correct slidesPerView
          swiper = new Swiper('.swiper', {
              loop: true,
              slidesPerView: checkResolution(),
                 navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev',
              },
              autoplay: {
                delay: 2000,
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
    

    
        // buat fungsi untuk cek resolusi. jika resolusi atau media query mobila maka return nilai tertentu pada slidesperview
        function checkResolution() {
          var slidesPerView = 4;
          if (window.innerWidth <= 760) {
            slidesPerView = 3;
          } 
          if (window.innerWidth <= 600) {
            slidesPerView = 2;
          } 
          if (window.innerWidth <= 400) {
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