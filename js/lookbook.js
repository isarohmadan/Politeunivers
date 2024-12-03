document.addEventListener('DOMContentLoaded', function() {

  // check is there class named swiper
      if (document.querySelector('.swiper')) {
  
            var swiper = new Swiper('.swiper', {
                slidesPerView: checkResolution(),
                loop: true,
                navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev',
                },
                on: {
                 },
              });
            }
  
  
      // buat fungsi untuk cek resolusi. jika resolusi atau media query mobila maka return nilai tertentu pada slidesperview
      function checkResolution() {
          var slidesPerView = 4;
          if (window.innerWidth <= 760) {
              slidesPerView = 1;
          }
          return slidesPerView;
      }
  
  
      
      
  
  
  
  });
  