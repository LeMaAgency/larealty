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

    $(document).off('click', '.js-form-open').on('click', '.js-form-open', function (e) {
        e.preventDefault();
        var formId = $('#' + $(this).data('form-id')),
            title = $(this).data('form-title'),
            id = $(this).data('id'),
            offerId = $(this).data('offer-id'),
            infoblockCode = $(this).data('infoblock-code');

        if (typeof id != 'undefined') {
            formId.find('input[name="id"]').val(id);
        }
        if (typeof offerId != 'undefined') {
            formId.find('input[name="offer_id"]').val(offerId);
        }
        if (typeof infoblockCode != 'undefined') {
            formId.find('input[name="infoblock-code"]').val(infoblockCode);
        }
        formId.find('h2').html(title);
        $.fancybox.open(formId);
    });

    $(document).on('change', 'select.js-sort-select', function () {
        var selectedIndex = $(this).find('option').context.selectedIndex,
            option = $(this).find('option[value="' + selectedIndex + '"]');
        if (option.data('url')) {
            window.location.href = option.data('url');
        }
    });
    $(document).off('click', '.js-show-offer').on('click', '.js-show-offer', function (e) {
        e.preventDefault();
        $(this).closest('.container').find('table.offer-table tr').each(function (i, elem) {
            $(elem).show();
        });
        $(this).hide();
    });

    $(document).off('click', '.button-list div').on('click', '.button-list div', function (e) {
        var value = $(this).data('value');
        $(this).closest('.filter-row').find('select.js-realty-type option').each(function (i, elem) {
            if ($(elem).val() == value) {
                $(elem).attr("selected", true);
            } else {
                $(elem).attr("selected", false);
            }
            console.log($(elem), $(elem).val(), value, $(elem).val() == value);
        });
    });
    $('form.js-subscribe-form').on('submit', function (e) {
        e.preventDefault();
        var curForm = $(this),
            waitElement = curForm.find('input[type="submit"], button[type="submit"]').get(0);
        BX.showWait(waitElement);
        $.post($(this).attr('action'), $(this).serialize(), function (ans) {
            BX.closeWait(waitElement);
            curForm.find('.core__form__input__log_danger').empty();
            if (ans && ans['errors']) {
                //show errors on inputs
                for (var inputName in ans.errors) {
                    curForm.find('[name="' + inputName + '"]').closest('.js-field-block').find('.core__form__input__log_danger').html(ans['errors'][inputName]);
                }
                //show message with errors
                $.fancybox.open(
                    '<div style="margin:25px;padding:35px;color:red;">' +
                    $.map(ans.errors, function (e) {
                        return e;
                    }).join('<br>') +
                    '</div>'
                )
            }
            else {
                //show success message
                $.fancybox.open('<div style="margin:25px;padding:35px;color:green;text-align:center;">Вы успешно подписались!</div>');
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
                $.fancybox.open(
                    '<div style="margin:25px;padding:35px;color:red;">' +
                    $.map(ans.errors, function (e) {
                        return e;
                    }).join('<br>') +
                    '</div>'
                )
            }
            else {
                //ok
                curForm.find('input:not([type="submit"]):not([type="button"]), textarea').val('').css({'border': '1px solid black'});
                $.fancybox.open('Спасибо за заявку. В ближайшее время мы Вам перезвоним')
            }
        }, 'json');
        return false;
    });
    $('.js-consultation-form-open').on('click', function (e) {
        e.preventDefault();
        $.fancybox.open($('#consultation-form'));
    });
    $(".fancybox").fancybox({
        openEffect: 'none',
        closeEffect: 'none'
    });

    $('.js-statistic-list').off('click').on('click', function (e) {
        e.preventDefault();
        $.fancybox.open($('#statistic-list'));
    })

    //Меню десктом
    $('.main-menu .have_submenu').hover(
        function () {
            $(this).find('.submenu').fadeIn(200)
        },
        function () {
            $(this).find('.submenu').fadeOut(200)
        }
    )
    //меню моб.
    $('.main-menu_mobile .have_submenu .open_submenu').on('click',function (e) {
        $(this).closest('.have_submenu').find('.submenu').slideToggle()
    })

//форма заявки на продажу или покупку
    $('form.js-sale_page-form').on('submit', function (e) {

        e.preventDefault();
        var curForm = $(this),
            waitElement = curForm;
        var name = curForm.find('[name=name]').val();
        var phone = curForm.find('[name=phone]').val();
        var comment = curForm.find('[name=comment]').val();
        var data = new FormData(curForm[0]);


        var phoneRegex = /^\+7\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}$/;
        var fileNameRegex = /\.(?:jpeg|jpg|png|doc|docx)$/;
        var validatePhoneStatus;
        var validateFilesStatus;

        //валидация телефона
        validatePhoneStatus = phone.match(phoneRegex);
        if(validatePhoneStatus === null){
            curForm.find('[name=phone]').closest('.it-block').find('.it-error').text('Телефон должен быть в формате +7(999)666-33-11')
            return false;
        }
        //Валидация файлов
        var files = $('#file_input_arenda_prodazha').prop("files")
        var fileNames = $.map(files, function(val) { return val.name; });
        if(fileNames.length > 0){
            for(i=0; i < fileNames.length;i++){
                validateFilesStatus = fileNames[i].match(fileNameRegex)
                if(validateFilesStatus === null)
                    break;
            }
            if(validateFilesStatus === null){
                alert('Недопустимый формат некоторых файлов')
                return false;
            }
        }

        BX.showWait(waitElement);
        $.ajax({
            url:$(this).attr('action'),
            type: 'POST',
            data: data,
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',progress, false);
                }
                return myXhr;
            },
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (ans) {

                BX.closeWait(waitElement);

                curForm.find('input:not([type="submit"]):not([type="button"]), textarea').css({'border': '1px solid #dfcd7d'});

                if (ans && ans.errors) {
                    curForm.find('.it-error').empty();
                    for (var inputName in ans.errors) {
                        curForm.find('[name="' + inputName + '"]').first().css({border: '1px solid red'})
                            .closest('.it-block').find('.it-error').html(ans.errors[inputName]);
                    }
                    $('#file_input_arenda_prodazha').val('')
                    $('#file_count').text('')
                    $('#upload_progress').text('')
                }
                else if(ans && ans.max_files){
                    alert('Прикрепить можно не более 10 файлов. Попробуйте еще раз.')
                }
                else {
                    //ok
                    $('#file_input_arenda_prodazha').val('')
                    $('#file_count').text('')
                    $('#upload_progress').text('')
                    curForm.find('input:not([type="submit"]):not([type="button"]), textarea').val('').css({'border': '1px solid black'});
                    $.fancybox.open('Спасибо за заявку. В ближайшее время мы Вам перезвоним')
                }
            },

        })
        return false;

    });

    function progress(e){

        if(e.lengthComputable){
            var max = e.total;
            var current = e.loaded;

            var Percentage = (current * 100)/max;
            $('#upload_progress').text('Идет отправка файлов... '+Percentage.toFixed(1)+'%');


            if(Percentage >= 100)
            {
                $('#upload_progress').text('Отправка завершена!')
            }
        }
    }
    //счетчик прикрепленных файлов к форме заявки
    $('#file_input_arenda_prodazha').on('change',function () {
        var fileCount = this.files.length;
        if(fileCount > 10){
            alert('Прикрепить можно не более 10 файлов. Попробуйте еще раз.')
            $(this).val('');
            $('#file_count').text('')
        }
        else {
            $('#file_count').text('('+fileCount+')')
        }
    })

    $('.phone_mask').mask('+7(000)000-00-00')

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

        if (address.length) {
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
            if (address.length) {
                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });
            }
        });


    }
}

