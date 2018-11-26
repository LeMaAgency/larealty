$(function () {
    $('form.js-feedback-form').on('submit', function (e) {

        e.preventDefault();

        var curForm = $(this),
            waitElement = curForm.find('input[type="submit"], button[type="submit"]').get(0);

        BX.showWait(waitElement);

        $.post($(this).attr('action'), $(this).serialize(), function (ans) {

            BX.closeWait(waitElement);

            curForm.find('input:not([type="submit"]):not([type="button"]), textarea').css({'border': '1px solid #dfcd7d'});

            if (ans && ans.errors) {
                curForm.find('.it-error').empty();
                for (var inputName in ans.errors) {
                    curForm.find('[name="' + inputName + '"]').first().css({border: '1px solid red'})
                        .closest('.it-block').find('.it-error').html(ans.errors[inputName]);
                }
            }
            else {
                //ok
                curForm.find('input:not([type="submit"]):not([type="button"]), textarea').val('').css({'border': '1px solid black'});
                $.fancybox.open('Спасибо за заявку. В ближайшее время мы Вам перезвоним')
            }
        }, 'json');
        return false;
    });
    $('form.js-assign-view-form').on('submit', function (e) {

        e.preventDefault();

        var curForm = $(this),
            waitElement = curForm.find('input[type="submit"], button[type="submit"]').get(0);

        BX.showWait(waitElement);

        $.post($(this).attr('action'), $(this).serialize(), function (ans) {

            BX.closeWait(waitElement);

            curForm.find('input:not([type="submit"]):not([type="button"]), textarea').css({'border': '1px solid #dfcd7d'});

            if (ans && ans.errors) {
                curForm.find('.it-error').empty();
                for (var inputName in ans.errors) {
                    curForm.find('[name="' + inputName + '"]').first().css({border: '1px solid red'})
                        .closest('.it-block').find('.it-error').html(ans.errors[inputName]);
                }
            }
            else {
                //ok
                curForm.find('input:not([type="submit"]):not([type="button"]), textarea').val('').css({'border': '1px solid black'});
                $.fancybox.open('Спасибо за заявку. В ближайшее время мы Вам перезвоним')
            }
        }, 'json');
        return false;
    });
    $('form.js-contacts-form').on('submit', function (e) {

        e.preventDefault();

        var curForm = $(this),
            waitElement = curForm.find('input[type="submit"], button[type="submit"]').get(0);

        BX.showWait(waitElement);

        $.post($(this).attr('action'), $(this).serialize(), function (ans) {

            BX.closeWait(waitElement);

            curForm.find('input:not([type="submit"]):not([type="button"]), textarea').css({'border': '1px solid #dfcd7d'});

            if (ans && ans.errors) {
                curForm.find('.it-error').empty();
                for (var inputName in ans.errors) {
                    curForm.find('[name="' + inputName + '"]').first().css({border: '1px solid red'})
                        .closest('.it-block').find('.it-error').html(ans.errors[inputName]);
                }
            }
            else {
                //ok
                curForm.find('input:not([type="submit"]):not([type="button"]), textarea').val('').css({'border': '1px solid black'});
                $.fancybox.open('Спасибо за заявку. В ближайшее время мы Вам перезвоним')
            }
        }, 'json');
        return false;
    });
    $('form.js-order-call-form').on('submit', function (e) {

        e.preventDefault();

        var curForm = $(this),
            waitElement = curForm.find('input[type="submit"], button[type="submit"]').get(0);

        BX.showWait(waitElement);

        $.post($(this).attr('action'), $(this).serialize(), function (ans) {

            BX.closeWait(waitElement);

            curForm.find('input:not([type="submit"]):not([type="button"]), textarea').css({'border': '1px solid #dfcd7d'});

            if (ans && ans.errors) {
                curForm.find('.it-error').empty();
                for (var inputName in ans.errors) {
                    curForm.find('[name="' + inputName + '"]').first().css({border: '1px solid red'})
                        .closest('.it-block').find('.it-error').html(ans.errors[inputName]);
                }
            }
            else {
                //ok
                curForm.find('input:not([type="submit"]):not([type="button"]), textarea').val('').css({'border': '1px solid black'});
                $.fancybox.open('Спасибо за заявку. В ближайшее время мы Вам перезвоним')
            }
        }, 'json');
        return false;
    });

    $(document).off('click', '.js-assign-view').on('click', '.js-assign-view', function (e) {
        e.preventDefault();
        var id = $(this).data('id'),
            offer_id = $(this).data('offer-id');
        $('#assign-view-form').find("input[name='id']").val(id);
        $('#assign-view-form').find("input[name='offer-id']").val(offer_id);
        $.fancybox.open($('#assign-view-form'));
    });
    $(document).off('click', '.js-order-call').on('click', '.js-order-call', function (e) {
        e.preventDefault();
        $.fancybox.open($('#order-call-form'));
    });
    $(document).off('click', '.js-sort div').on('click', '.js-sort div', function () {
        if ($(this).data('url')) {
            window.location.href = $(this).data('url');
        }
    });
    $(document).off('click', '.js-show-offer').on('click', '.js-show-offer', function (e) {
        e.preventDefault();
       $(this).closest('.container').find('table.offer-table tr').each(function (i,elem) {
           $(elem).show();
       });
       $(this).hide();
    });

    $(document).off('click', '.button-list div').on('click', '.button-list div', function (e) {
        var value = $(this).data('value');
        $(this).closest('.filter-row').find('select.js-realty-type option').each(function (i,elem) {
            if($(elem).val() == value){
                $(elem).attr("selected",true);
            }else{
                $(elem).attr("selected",false);
            }
            console.log($(elem),$(elem).val(),value,$(elem).val() == value);
        });
    });

});
function initMap() {

    var map,
        myLatLng;

    myLatLng = {
        lat: 49.938829,
        lng: 30.697245
    };
    if (document.getElementById('map-location-flat') !== null) {
        var coords = $('#map-location-flat').data('coords'),
            address = $('#map-location-flat').data('address');

        if (coords && (coords = coords.split(','))) {
            myLatLng = {
                lat: parseFloat(coords[0]),
                lng: parseFloat(coords[1])
            }
        }
        // Create a map object and specify the DOM element for display.
        map = new google.maps.Map(document.getElementById('map-location-flat'), {
            center: myLatLng,
            zoom: 15,
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
                /*icon: '/assets/img/icons/map-location-flat.png'*/
            }
        };

        var features = [
            {
                position: new google.maps.LatLng(myLatLng.lat, myLatLng.lng),
                type: 'newFlat'
            }
        ];

        if(address.length) {
            var infowindow = new google.maps.InfoWindow({
                content: address,
                maxWidth: 200
            });
        }

        // Create markers.
        features.forEach(function (feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                map: map
            });
            if(address.length) {
                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });
            }
        });


    }
}

