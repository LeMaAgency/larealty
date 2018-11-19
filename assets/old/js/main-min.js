$(document).ready(function () {
    $('.top-slider').owlCarousel({
        items: 1,
        margin: 0,
        loop: true,
        nav: true,
        dots: true
    });


    var doubleHandleSlider = document.querySelector('.filter-price-slider');
    var minValInput = document.querySelector('.filter-min-value-input');
    var maxValInput = document.querySelector('.filter-max-value-input');
    var snapValues = [
        document.querySelector('.filter-min-value'),
        document.querySelector('.filter-max-value')
    ];

    if(doubleHandleSlider !== null) {
        // Price Slider
        noUiSlider.create(doubleHandleSlider, {
            start: [8000000, 85000000],
            connect: true,
            step: 1000,
            range: {
                'min': [8000000],
                'max': [85000000]
            }
        });
        doubleHandleSlider.noUiSlider.on('change', function (values, handle) {
            var rangeValues = values;
            minValInput.value = rangeValues[0];
            maxValInput.value = rangeValues[1];
        });


        minValInput.addEventListener('change', function () {
            doubleHandleSlider.noUiSlider.set([this.value, null]);
        });

        maxValInput.addEventListener('change', function () {
            doubleHandleSlider.noUiSlider.set([null, this.value]);
        });
        doubleHandleSlider.noUiSlider.on('update', function (values, handle) {
            snapValues[handle].innerHTML = values[handle];
        });
    }

    // Select
    $('.filter-select-link').click(function () {
        var dropBlock = $(this).parent().find('.filter-select-drop');
        if (dropBlock.is(':hidden')) {
            dropBlock.slideDown();
            $(this).addClass('active filter-border-color');
            $('.filter-select-drop').find('li').click(function () {
                var selectResult = $(this).html();
                $(this).closest('.filter-select').find('input').val(selectResult);
                $(this).closest('.filter-select').find('.filter-select-link').removeClass('active').html(selectResult);
                dropBlock.slideUp();
            });
        } else {
            $(this).removeClass('active');
            dropBlock.slideUp();
        }
        return false;
    });

    var mobile = $('.mobile-menu');
    var menu = $('.header-menu');

    $(mobile).on('click', function (e) {
        e.preventDefault();
        menu.toggleClass('opened');
        mobile.toggleClass('toggled-on');
    });

    $('.filter-price-input').click(function () {
        $(this).addClass('filter-border-color');
    });


    //  ативация SelectFx для кастомизации селектов
    (function () {
    [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {
            new SelectFx(el);
        });
    })();

});

$(document).ready(function () {

    //  инициализация карт на странице catalog-search

    var map,
        map2,
        map3,
        map4,
        myLatLng;

    function initMap() {
        myLatLng = {
            lat: 55.675201,
            lng: 37.633140
        };

        if(document.getElementById('map') !== null) {

            // Create a map object and specify the DOM element for display.
            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 10,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false
            });


            var icons = {
                newFlat: {
                    name: 'newFlat',
                    icon: '/assets/img/icons/place-mark.png'
                }
            };
            var features = [
                {
                    position: new google.maps.LatLng(55.717780, 37.701821),
                    type: 'newFlat'
              }, {
                    position: new google.maps.LatLng(55.609196, 37.368095),
                    type: 'newFlat'
              }
            ];
            // Create markers.
            features.forEach(function (feature) {
                var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map
                });
            });

            // Create a map object and specify the DOM element for display.
            map2 = new google.maps.Map(document.getElementById('map-2'), {
                center: myLatLng,
                zoom: 10,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false
            });

            var features2 = [
                {
                    position: new google.maps.LatLng(55.847757, 37.448378),
                    type: 'newFlat'
              }, {
                    position: new google.maps.LatLng(55.820392, 37.741523),
                    type: 'newFlat'
              }
            ];

            // Create markers.
            features2.forEach(function (feature) {
                var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map2
                });
            });

            // Create a map object and specify the DOM element for display.
            map3 = new google.maps.Map(document.getElementById('map-3'), {
                center: myLatLng,
                zoom: 10,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false
            });

            var features3 = [
                {
                    position: new google.maps.LatLng(55.717780, 37.701821),
                    type: 'newFlat'
              }, {
                    position: new google.maps.LatLng(55.609196, 37.368095),
                    type: 'newFlat'
              }
            ];

            // Create markers.
            features3.forEach(function (feature) {
                var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map3
                });
            });

            // Create a map object and specify the DOM element for display.
            var map4 = new google.maps.Map(document.getElementById('map-4'), {
                center: myLatLng,
                zoom: 10,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false
            });

            var features4 = [
                {
                    position: new google.maps.LatLng(55.847757, 37.448378),
                    type: 'newFlat'
              }, {
                    position: new google.maps.LatLng(55.820392, 37.741523),
                    type: 'newFlat'
              }
            ];

            // Create markers.
            features4.forEach(function (feature) {
                var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map4
                });
            });
        }
    }

    initMap();

    //  выделение активной кнопки таб панели и активация карты во вкладке
    var newFlatsTabNav = $('.new-flats__tab-nav');
    newFlatsTabNav.click(function (e) {
        e.preventDefault();
        var thisTab = $(this);
        newFlatsTabNav.removeClass('active');
        thisTab.addClass('active');
        var idActive = thisTab.attr('href');
        $('.tab-pane').hide();
        $(idActive).show();
        initMap();
    })
});

$(document).ready(function () {
    //  слайдер услуг

    $('.slider-services__slider').slick({
        arrows: true,
        prevArrow: "<svg class='arrows arrows--prev' width='42' height='42' viewBox='0 0 477.175 477.175'><path d='M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z'/></svg>",
        nextArrow: "<svg class='arrows arrows--next' width='42' height='42' viewBox='0 0 477.175 477.175'><path d='M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z'/></svg>"
    });


    //  переключение активных картинок над слайдером
    var sliderServicesItem = $('.slider-services__slider__item'),
        sliderServicesImg = $('.slider-services__img__item');

    $('.arrows--prev').click(function () {
        var dataSlider = sliderServicesItem.filter('.slick-active').data('slider');
        sliderServicesImg.removeClass('active')
        sliderServicesImg.filter("[data-img='" + dataSlider + "']").addClass('active');
    });
    $('.arrows--next').click(function () {
        var dataSlider = sliderServicesItem.filter('.slick-active').data('slider');
        sliderServicesImg.removeClass('active')
        sliderServicesImg.filter("[data-img='" + dataSlider + "']").addClass('active');
    });

});

$(document).ready(function () {
    // слайдер фото квартиры

    $('.flat-details__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.flat-details__slider_nav'
    });
    $('.flat-details__slider_nav').slick({
        slidesToShow: 5,
        slidesToScroll: 0,
        asNavFor: '.flat-details__slider',
        arrows: false,
        centerMode: true,
        focusOnSelect: true,
        vertical: true,
        responsive: [
            {
                breakpoint: 771,
                settings: {
                    vertical: false
                }
            },
            {
                breakpoint: 640,
                settings: {
                    vertical: false,
                    slidesToShow: 3,
                    slidesToScroll: 0
                }
            },
            {
                breakpoint: 500,
                settings: {
                    vertical: false,
                    slidesToShow: 2,
                    slidesToScroll: 0
                }
            },
            {
                breakpoint: 380,
                settings: {
                    vertical: false,
                    slidesToShow: 1,
                    slidesToScroll: 0
                }
            }
        ]
    });

    var navItem = $('.flat-details__slider_nav__item__wrap');
    navItem.click(function () {
        navItem.removeClass('active');
        $(this).addClass('active');
    });
});


$(document).ready(function () {

    //  инициализация карт на странице map
    var map,
        myLatLng;

    function initMap() {
        myLatLng = {
            lat: 49.938829,
            lng: 30.697245
        };
        if(document.getElementById('map-location-flat') !== null) {
            // Create a map object and specify the DOM element for display.
            map = new google.maps.Map(document.getElementById('map-location-flat'), {
                center: myLatLng,
                zoom: 8,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false
            });

            var icons = {
                newFlat: {
                    name: 'newFlat',
                    icon: 'img/icons/map-location-flat.png'
                }
            };

            var features = [
                {
                    position: new google.maps.LatLng(50.103587, 29.929313),
                    type: 'newFlat'
              }
            ];

            // Create markers.
            features.forEach(function (feature) {
                var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map
                });
            });
        }
    }


    initMap();

    //  выделение активной кнопки таб панели и активация карты во вкладке
    var flatOnMapNav = $('.flat-on-map__nav__item');
    flatOnMapNav.click(function (e) {
        e.preventDefault();
        var thisNav = $(this);
        flatOnMapNav.removeClass('active');
        thisNav.addClass('active');
        var idActive = thisNav.attr('href');
        $('.flat-on-map__content').hide();
        $(idActive).show();
        initMap();
    })
});

$(document).ready(function () {

    var map; //<-- This is now available to both event listeners and the initialize() function
    function initialize() {

      var greyScaleMapType = new google.maps.StyledMapType(
        [{"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#e9e9e9"},{"lightness": 17}]},
        {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"},{"lightness": 20}]},
        {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"},{"lightness": 17}]},
        {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#ffffff"},{"lightness": 29},{"weight": 0.2}]},
        {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#ffffff"},{"lightness": 18}]},
        {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#ffffff"},{"lightness": 16}]},
        {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#f5f5f5"},{"lightness": 21}]},
        {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#dedede"},{"lightness": 21}]},
        {"elementType": "labels.text.stroke", "stylers": [{"visibility": "on"},{"color": "#ffffff"},{"lightness": 16}]},
        {"elementType": "labels.text.fill", "stylers": [{"saturation": 36},{"color": "#333333"},{"lightness": 40}]},
        {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]},
        {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#f2f2f2"},{"lightness": 19}]},
        {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#fefefe"},{"lightness": 20}]},
        {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#fefefe"},{"lightness": 17},{"weight": 1.2}]}], {
        name: 'greyScale'
      });

      var greyScaleMapTypeId = 'grey_Scale';

      var myLatLng = {lat: 55.748700, lng: 37.622860};
      var mapOptions = {
       center: myLatLng,
       zoom: 10,
        mapTypeControlOptions: {
          mapTypeIds: [google.maps.MapTypeId.ROADMAP, greyScaleMapTypeId]
        },
       disableDefaultUI: true

      };
      map = new google.maps.Map(document.getElementById('map_contacts'), mapOptions);
      map.mapTypes.set(greyScaleMapTypeId, greyScaleMapType);
      map.setMapTypeId(greyScaleMapTypeId);

     var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: 'img/icons/map-marker.png'
      });
    }
    if(document.getElementById('map_contacts') !== null) {
        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
    }
});


