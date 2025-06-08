$(".datatable-original").DataTable({
    responsive: true,
    order: [[2, 'desc']]
});

// select js
$(document).ready(function() {
    $('.category-select').select2();
});   

$('.responsive').slick({
  slidesToShow: 2,
  slidesToScroll: 2,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1
      }
    },
  ]
});
