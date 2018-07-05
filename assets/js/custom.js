$(function () {
    $('.offers-filter-btn').on('click', function () {
        var offersBlock = $(this).closest('.offers'),
            offers = offersBlock.find('.offers-list a'),
            selectors = ['realty-type', 'rent-type'],
            selector = '';

        offers.hide();

        for (var i in selectors) {
            if ($(this).data(selectors[i]))
                selector += '[data-' + selectors[i] + '="' + $(this).data(selectors[i]) + '"]'
        }
        offersBlock.find(selector).show('slow');
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
    })
});
$(document).ready(function () {
    $("body").on("click", ".js-all-realtors", function () {
        if ($(this).hasClass("js-hidden")) {
            $(this).html("Все риэлторы");
            $(this).removeClass("js-hidden");
            $(this).closest(".realtors").find(".spoiler").toggle(500);
        } else {
            $(this).html("Скрыть");
            $(this).addClass("js-hidden");
            $(this).closest(".realtors").find(".spoiler").toggle(500);
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

    $('body').on('click', '.js-change-text-slider-sync .slider-services__img__item', function(e) {
        e.preventDefault();
        $( '.slider-services__slider').slick('slickGoTo', parseInt($(this).data('img')) -1 )
    });

    $('body').on('click', '.js-collapse-props', function (e) {
        e.preventDefault();
        if($(this).siblings('.js-collapsed').is(':visible'))
        {
            $(this).siblings('.js-collapsed').hide(400)
                .end()
                .find('span').text('Развернуть');
        }
        else
        {
            $(this).siblings('.js-collapsed').show(400)
                .end()
                .find('span').text('Свернуть');
        }
    })

});
