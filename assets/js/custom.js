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
});