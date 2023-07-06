

$(document).ready(function(){
  setInterval(function(){
      let currentSlide = $('.mobile-swiper-container').scrollLeft();
      let slideWidth = $('.items').outerWidth();
      let nextSlide = currentSlide + slideWidth;
      if(nextSlide >= $('.mobile-swiper-container')[0].scrollWidth){
          nextSlide = 0;
      }
      $('.mobile-swiper-container').animate({scrollLeft: nextSlide}, 1000);
  }, 3000);
});
