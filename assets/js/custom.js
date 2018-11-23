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

    $(document).off('click', '.js-assign-view').on('click', '.js-assign-view', function (e) {
        e.preventDefault();
        var id = $(this).data('id'),
            offer_id = $(this).data('offer-id');
        $('#assign-view-form').find("input[name='id']").val(id);
        $('#assign-view-form').find("input[name='offer-id']").val(offer_id);
        $.fancybox.open($('#assign-view-form'));
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
