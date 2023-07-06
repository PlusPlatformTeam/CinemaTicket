const swiper = new Swiper('.swiper', {
  direction: 'horizontal',
  loop: true,

  pagination: {
      el: '.swiper-pagination',
      clickable: true,
  },

  autoplay: {
      delay: 3000,
      pauseOnMouseEnter: true,
      disableOnInteraction: false
  },

  navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
  },

});

$(document).ready(function() {
  let container = $('.mobile-swiper-container');
  let items = container.find('.items');
  let itemWidth = items.outerWidth(true);
  let autoScrollInterval = 3000;
  let scrollDuration = 1000;

  container.append(items.clone());

  let scrollInterval = setInterval(function() {
    let scrollLeft = container.scrollLeft();
    if (scrollLeft + container.width() >= container[0].scrollWidth) {
      container.scrollLeft(0);
      scrollLeft = 0;
    }
    container.animate({ scrollLeft: scrollLeft + itemWidth }, scrollDuration);
  }, autoScrollInterval);

  container.on('mouseenter', function() {
    clearInterval(scrollInterval);
  });

  container.on('mouseleave', function() {
    scrollInterval = setInterval(function() {
      let scrollLeft = container.scrollLeft();
      if (scrollLeft + container.width() >= container[0].scrollWidth) {
        container.scrollLeft(0);
        scrollLeft = 0;
      }
      container.animate({ scrollLeft: scrollLeft + itemWidth }, scrollDuration);
    }, autoScrollInterval);
  });
});
