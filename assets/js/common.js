$(document).ready(function() {


 

  /*Маленький сладейр с акциями на главной*/
  $('.small_stock-slide').slick({
	  infinite: false,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  prevArrow: '<div class="prev-stock"><img src="/assets/img/prev-b.png" alt="prev" /></div>',
	  nextArrow: '<div class="next-stock"><img src="/assets/img/next-b.png" alt="next" /></div>',
	  dots: true
	});

  /*Большой сладейр с акциями на главной*/
  $('.big_stock-slide').slick({ 
	  infinite: false,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  prevArrow: '<div class="prev-stock"><img src="/assets/img/prev-b.png" alt="prev" /></div>',
	  nextArrow: '<div class="next-stock"><img src="/assets/img/next-b.png" alt="next" /></div>',
	  dots: true
	});

  $('.item-card_photo').slick({
    dots: true,
    infinite: false,
    prevArrow: '<div class="prev-card"><img src="/assets/img/left-b.png" alt="prev" /></div>',
    nextArrow: '<div class="next-card"><img src="/assets/img/right-b.png" alt="next" /></div>',
  });


  $('.btn-menu a, .header-item.close').click(function(){
  	$('.open-menu').slideToggle('slow');
  });

  $('.main-menu ul > li').clone().appendTo('.mobile-menu').removeAttr('class');
  $('.header-menu ul > li').clone().appendTo('.mobile-menu');
  
  $('.mobile-menu li:nth-child(4) a').addClass('active');


  var someDiv1 = $('.button-list div');
  var someDiv2 = $('.button-currency div');
  someDiv1.on('click', function() {
    someDiv1.removeClass('btn__item--active');
    $(this).addClass('btn__item--active');
  });
  someDiv2.on('click', function() {
    someDiv2.removeClass('currency__item--active');
    $(this).addClass('currency__item--active');
  });
  var someDiv3 = $('.sort-list_count div');
  someDiv3.on('click', function() {
    someDiv3.removeClass('sort-list_count-active');
    $(this).addClass('sort-list_count-active');
  });
  var someDiv4 = $('.sort-list_type div');
  someDiv4.on('click', function() {
    someDiv4.removeClass('sort-list_type-active');
    $(this).addClass('sort-list_type-active');
  });


  $(function(){

  $(".offer-tabs").on("click", ".tab", function(){

    var tabs = $(".offer-tabs .tab"),
        cont = $(".offer-tabs .tab-cont");

    // Удаляем классы active
    tabs.removeClass("active");
    cont.removeClass("active");
    // Добавляем классы active
    $(this).addClass("active");
    cont.eq($(this).index()).addClass("active");

    return false;
  });
});

   /*Сладейр с новинками на главной*/ 
  $('.newoffer-slider').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    prevArrow: '<div class="prev-new"></div>',
    nextArrow: '<div class="next-new"></div>',
    responsive: [
    {
      breakpoint: 1199,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: true,
        arrows: false
      }
    },
  
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false
      }
    }
  ]
  });
});
