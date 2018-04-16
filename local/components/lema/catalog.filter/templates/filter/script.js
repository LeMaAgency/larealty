$(function() {
    $('.filter-select').each(function(i, el) {
        var linkText = $(el).find('ul.filter-select-drop li.selected').text() || 'Выбрать';

        $(el).find('.filter-select-link').text(linkText);
    });
});