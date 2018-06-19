$(function() {
    $('.filter-select').each(function(i, el) {
        var linkText = $(el).find('ul.filter-select-drop li.selected').text() || 'Выбрать';

        $(el).find('.filter-select-link').text(linkText);
    });
    $('.js-extend-filter').on('click', function(e) {
        e.preventDefault();
        $('.js-extend-filter-block').toggle();
        $(this).find('b').text($('.js-extend-filter-block').is(':visible') ? '-' : '+');
    })
});