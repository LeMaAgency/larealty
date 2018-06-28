$(function() {
    $('.filter-select').each(function(i, el) {
        var linkText = $(el).find('ul.filter-select-drop li.selected').text() || 'Выбрать';

        $(el).find('.filter-select-link').text(linkText);
    });
    $('.js-extend-filter').on('click', function(e) {
        e.preventDefault();
        $('.js-extend-filter-block').toggle();
        $(this).find('b').text($('.js-extend-filter-block').is(':visible') ? '-' : '+');
    });


    $('form.filter-form').on('submit', function() {
        /**
         * Change form action url
         */
        $(this).attr(
            'action',
            '/rent/'
                + $('input[name="arrFilter_pf[REALTY_TYPE]"]:checked').data('code')
                + '/'
                + $('input[name="arrFilter_pf[RENT_TYPE]"]:checked').data('code')
                + '/'
        );

        /**
         * Remove realty & rent types fields
         */
        $('input[name="arrFilter_pf[REALTY_TYPE]"], input[name="arrFilter_pf[RENT_TYPE]"]').remove()
    })

    $(document).on('click', '#rent-out-id', function(e) {
        e.preventDefault();

        $.fancybox.open($("#rent-form"));

        return false;
    });
});