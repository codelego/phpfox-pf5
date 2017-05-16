define(['jquery', 'core'], function () {
    var Core = require('core');

    $(document).on('core.moderator.check_all', function () {
        $('input.item_checkbox').prop('checked', true)
    }).on('core.moderator.uncheck_all', function () {
        $('input.item_checkbox').prop('checked', false)
    }).on('change', '.moderation-check-all', function () {
        var ele = $(this),
            checked = ele.prop('checked');
        ele.prop('checked', checked ? true : false);
        $(document).trigger(ele.prop('checked') ? 'core.moderator.check_all' : 'core.moderator.uncheck_all');
    }).on('change', '.item_checkbox', function () {

    });


});