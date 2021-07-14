/* Swiper setup Document */
//
var swiper = new Swiper('.swiper-container', {
 speed: 500,
 loop: true,
 centeredSlides: true,
 autoplay: {
  delay: 8000,
  disableOnInteraction: false,
 },
 navigation: {
  nextEl: '.swiper-button-next',
  prevEl: '.swiper-button-prev',
 },
 pagination: {
  el: '.swiper-pagination',
  //clickable: true,
  type: 'progressbar',
 },
 mousewheel: true,
 keyboard: true,
 breakpoints: {
  1280: {
   slidesPerView: 2,
   spaceBetween: 10,
  },
 }
});
