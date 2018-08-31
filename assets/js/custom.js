$(function () {
    $('.offers-filter-btn').on('click', function () {
        var offersBlock = $(this).closest('.offers'),
            offers = offersBlock.find('.offers-list a'),
            selectors = ['realty-type', 'rent-type'],
            arSelector = [],
            selector = '';
        if ($(this).data('realty-type')) {
            var arSelectors = JSON.parse("[" + $(this).data('realty-type') + "]");
        }
        if (!(offers.data('realty-type') || offers.data('rent-type'))) {
            offers = offersBlock.find('.offers-list div.js-elem-favorites');
        }
        offers.hide();

        for (var i in selectors) {
            if ($(this).data(selectors[i])) {
                if ((typeof arSelectors !== 'undefined') && arSelectors.length > 1) {
                    for (var j in arSelectors) {
                        arSelector[j] = '[data-' + selectors[i] + '="' + arSelectors[j] + '"]';
                    }
                } else {
                    selector += '[data-' + selectors[i] + '="' + $(this).data(selectors[i]) + '"]';
                }
            }
        }
        if (arSelector.length > 0) {
            for (var i in arSelector) {
                offersBlock.find(arSelector[i]).show('slow');
            }
        } else {
            offersBlock.find(selector).show('slow');
        }
    });

    $('.js-filter-fields').on('click', function () {
        var typeObject = $(this).attr('for').replace('type-', ''),
            checkAddElem = false;
        if (typeObject == 'zemelnyy_uchastok') {
            $('.propSquare').html('Площадь участка');
        } else {
            $('.propSquare').html('Площадь');
        }

        $('.js-filter-elem').each(function () {
            if ($(this).data('property-code').indexOf(typeObject) != '-1') {
                if ($(this).hasClass('js-extend-filter-block')) {
                    checkAddElem = true;
                    $(this).removeClass('crutch-filter');
                } else {
                    $(this).show();
                }
                $(this).find('input').each(function () {
                    $(this).attr('name', $(this).data('name'));
                });
            } else {
                if ($(this).hasClass('js-extend-filter-block')) {
                    $(this).addClass('crutch-filter');
                } else {
                    $(this).hide();
                }
                $(this).find('input').attr('name', '');
            }
            if (checkAddElem) {
                $('a.filter-extend-link').show();
            } else {
                $('a.filter-extend-link').hide();
            }
        });
    });


    $('form.js-rieltor-form').on('submit', function (e) {

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
                $.fancybox.open('Спасибо за заявку. В ближайшее время мы Вам перезвоним')
            }
        }, 'json');
        return false;
    });

    $('form.js-hypothec-form').on('submit', function (e) {
        e.preventDefault();
        var curForm = $(this),
            waitElement = curForm.find('input[type="submit"], button[type="submit"]').get(0),
            formData = new FormData($(this)[0]);
        BX.showWait(waitElement);
        $.ajax({
            method: curForm.attr('method'),
            url: curForm.attr('action'),
            dataType: 'json',
            data: formData,
            async: false,
            cache: false,
            processData: false,
            contentType: false,
            success: function (ans) {
                curForm.find('input:not([type="submit"]):not([type="button"]), textarea').css({'border': '3px solid #dfcd7d'});
                curForm.find('.it-error').empty();
                BX.closeWait(waitElement);
                if (ans && ans.errors) {
                    curForm.find('.it-error').empty();
                    for (var inputName in ans.errors) {
                        curForm.find('[name="' + inputName + '"]').first().css({border: '1px solid red'})
                            .closest('.it-block').find('.it-error').html(ans.errors[inputName]);
                    }
                }
                else {
                    //ok
                    curForm.find('input:not([type="submit"]):not([type="button"]), textarea').val('');
                    $.fancybox.open('Спасибо за заявку. В ближайшее время мы Вам перезвоним')
                }
            }
        });
        return false;
    });
    $('form.js-object-form').on('submit', function (e) {

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
    $('form.js-personal-office-form').on('submit', function (e) {

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
                curForm.find('.it-error').empty();
                $.fancybox.open('Данные успешно сохранены!')
            }
        }, 'json');
        return false;
    });
    $('.js-textarea-crutch textarea').on('change', function () {
        $(this).closest('.js-textarea-crutch').find('#form_field_message').val($(this).val());
    });


    /*Subscribe form*/

    $('form.js-subscribe-form').on('submit', function (e) {

        if ($(this).find("input[type=submit]:focus").attr('name') == 'subscribe') {
            e.preventDefault();
            var curForm = $(this),
                waitElement = curForm.find('input[type="submit"][name="subscribe"], button[type="submit"][name="subscribe"]').get(0);

            BX.showWait(waitElement);

            $.post('/ajax/add_subscribe.php', $(this).serialize(), function (ans) {

                BX.closeWait(waitElement);

                curForm.find('input[name="email"]').val('').css({'border': '0px solid'});

                if (ans && ans.errors) {
                    curForm.find('.it-error').empty();
                    for (var inputName in ans.errors) {
                        curForm.find('[name="' + inputName + '"]').first().css({border: '1px solid red'})
                            .closest('.it-block').find('.it-error').html(ans.errors[inputName]);
                    }
                }
                else {
                    //ok
                    curForm.find('input[name="email"]').val('').css({'border': '0px solid'});
                    $.fancybox.open('Ваша подписка успешно сохранена!');
                    $('.js-subcribe-block').html(
                        ' Вы подписались на новые объявления.<br>\n' +
                        'Изменить параметры уведомлений, отключить или удалить их можно в разделе\n' +
                        '<a href="/personal/subscriptions/">подписки</a>.'
                    );
                }
            }, 'json');
            return false;
        }
    });
});
$(document).ready(function () {

    $("body").on("click", ".js-all-realtors", function () {
        if ($(this).hasClass("js-hidden")) {
            $(this).text($(this).data('expand-title'))
                .removeClass("js-hidden")
                .closest(".realtors").find(".spoiler").toggle(500);
        } else {
            $(this).text($(this).data('collapse-title'))
                .addClass("js-hidden")
                .closest(".realtors").find(".spoiler").toggle(500);
        }
    });
    $("body").on("click", ".js-realtors-feedback", function (e) {
        e.preventDefault();
        $.fancybox.open($("#realtors-feedback-form"));
        $("#form_field_realtor_id").val($(this).data("id"));
    });
    $("body").on("click", ".js-feedback-form", function (e) {
        e.preventDefault();
        $.fancybox.open($("#feedback-form"));
        $("#feedback-form").find(".call-order-title").html($(this).html());
        $("#feedback-form").find("input[type='submit']").val("Отправить");
    });

    $("body").on("click", ".js-order-viewing", function (e) {
        e.preventDefault();
        $.fancybox.open($("#order-viewing"));
        $("#order-viewing").find("input[name='object']").val($(this).data('object'));
        $("#order-viewing").find(".call-order-title").html("Записаться на просмотр");
    });

    $("body").on("click", ".js-flat-fit-order", function (e) {
        e.preventDefault();
        $.fancybox.open($("#flat-fit-order"));
        $("#flat-fit-order").find(".call-order-title").html("Заказать подбор квартир");
    });

    $(document).on("click", "#order-viewing", function () {
        if ($("#order-viewing").find("input[name='object']").val() == '') {
            $("#order-viewing").find("input[name='object']").val($(".js-order-viewing").data('object'));
        }
    });

    $('body').on('click', '.js-change-text-slider-sync .slider-services__img__item', function (e) {
        e.preventDefault();
        $('.slider-services__slider').slick('slickGoTo', parseInt($(this).data('img')) - 1)
    });

    $('body').on('click', '.js-collapse-props', function (e) {
        e.preventDefault();
        if ($(this).siblings('.js-collapsed').is(':visible')) {
            $(this).siblings('.js-collapsed').hide(400)
                .end()
                .find('span').text('Развернуть');
        }
        else {
            $(this).siblings('.js-collapsed').show(400)
                .end()
                .find('span').text('Свернуть');
        }
    })
    //js favorites

    //add product to favorites
    var addToFavoritesFunc = function () {
        $(document).on('click', '.js-favorites-add', function (e) {
            e.preventDefault();
            var waitElement = this,
                itemId = $(this).data('item-id') * 1;

            //show ajax-loader
            BX.showWait(waitElement);

            //make request
            $.get('/ajax/favorites.php?action=add', {ID: itemId}, function (ans) {

                if (ans.status) {
                    $('.elem-' + itemId).removeClass('js-favorites-add');
                    $('.elem-' + itemId).addClass('js-favorites-delete active');
                    $('.elem-' + itemId + ' span').html("Удалить из избранного");
                    //set total count of positions
                    /* $('.js-favorites-positions-count > span').text(ans.positionsCount);*/

                    //hide ajax-loader
                    BX.closeWait(waitElement);
                    //show message
                    var check = 0,
                        positionId = '';
                    for (var i in ans.products) {
                        check++;
                        if (check == ans.positionsCount) {
                            positionId = ans.products[i].ID;
                        } else {
                            continue;
                        }
                    }
                    $('.elem-' + itemId).attr('data-position-id', positionId);
                }
                $.fancybox.open('<div class="popup__success">' +
                    (ans.inFavorites ? 'Объект уже находится в избранном' : ans.status ? 'Объект успешно добавлен в избранное' : 'Произошла ошибка при добавлении объекта') +
                    '</div>');

            }, 'json');

        });
    };
    addToFavoritesFunc();

    //delete item from favorites
    $(document).on('click', '.js-favorites-delete', function (e) {
        e.preventDefault();

        var waitElement = this,
            itemPosId = $(this).data('position-id') * 1,
            itemId = $(this).data('item-id') * 1;

        //show ajax-loader
        BX.showWait(waitElement);

        $.get('/ajax/favorites.php?action=delete', {ID: itemPosId}, function (ans) {
            if (ans.status) {
                $('.elem-' + itemId).removeClass('js-favorites-delete active');
                $('.elem-' + itemId).addClass('js-favorites-add');
                $('.elem-' + itemId + ' span').html("Добавить в избранное");

                var $existsPositions = Object.keys(ans.products);

                //remove deleted items
                $('.js-favorites-list .card-flat__content__favorites').each(function (i, el) {

                    if (!$(el).data('position-id'))
                        return;

                    if (-1 === $.inArray('' + $(el).data('position-id'), $existsPositions)) {
                        $(el).closest('.favorites-elem-' + itemId).remove();
                    }
                });
                /*
                            //update total sum
                            $('.sum-mega').text(ans.totalSumFormatted);

                            $('.js-favorites-positions-count > span').text(ans.positionsCount);*/

                //hide ajax-loader
                BX.closeWait(waitElement);

            }
            $.fancybox.open('<div class="popup__success">' +
                (ans.status ? 'Объект успешно удален из избранного' : 'Произошла ошибка при удалении объекта') +
                '</div>');
        }, 'json');
    });
});

$(document).on('click', '.filter-select-drop li', function () {
    var type = $(this).data('value'),
        name = $(this).data('name');

    $(this).closest('.filter-select').find('.js-realty-type-name').val(name);

    $('.all-properties-object .js-type').each(function () {
        $(this).hide();
    });
    $('.all-properties-object .js-type-' + type).each(function () {
        $(this).show();
    });
});
