$(function () {
    $('select.js-select-sections').change(function () {
        var section = $(this).find('option:selected').val(),
            formAction = $(this).closest('form').attr('action').split('/');
        if(formAction[2] != section) {
            formAction[2] = section;
            formAction[3] = '';
            $(this).closest('form').attr('action', formAction.join('/'));
        }
    });
});