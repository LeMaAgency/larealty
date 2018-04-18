$(function() {
    $('.offers-filter-btn').on('click', function() {
        var offersBlock = $(this).closest('.offers'),
            offers = offersBlock.find('.offers-list a'),
            selectors = ['realty-type', 'rent-type'],
            selector = '';

        offers.hide();

        for(var i in selectors) {
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

            if (ans && ans.errors)
            {
                curForm.find('.it-error').empty();
                for(var inputName in ans.errors)
                {
                    curForm.find('[name="' + inputName + '"]').first().css({border: '1px solid red'})
                        .closest('.it-block').find('.it-error').html(ans.errors[inputName]);
                }
            }
            else
            {
                //ok
                $.fancybox.open('Спасибо за заявку. В ближайшее время мы Вам перезвоним')
            }
        }, 'json');
        return false;
    })
});