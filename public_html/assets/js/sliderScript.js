document.addEventListener('DOMContentLoaded', function () {
  var myCarousel = document.getElementById('carouselExample');
  var carousel = new bootstrap.Carousel(myCarousel, {
      interval: 8000,
      ride: 'carousel'
  });

  console.log('Script cargado');

  myCarousel.addEventListener('slid.bs.carousel', function (event) {
      var activeItem = event.relatedTarget;
      var newBg = activeItem.getAttribute('data-bg');

      if (newBg) {
          myCarousel.style.backgroundImage = `url('${newBg}')`;
      }
  });
});
