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

    Core.cmd('toggle', function (btn) {
        var prop = btn.data('rel').split(':'),
            rel = prop[0].split('|'),
            classes = prop[1];

        switch (rel.length) {
            case 0:
                btn.toggleClass(classes);
                break;
            case 2:
                if (rel[1] != '') {
                    btn.closest(rel[0])
                        .find(rel[1])
                        .toggleClass(classes);
                } else {
                    btn.closest(rel[0])
                        .toggleClass(classes);
                }
                break;
            case 1:
                $(rel[0]).toggleClass(classes);
                break;
            case 3:

        }
    }).cmd('form.cmd', function (ele) {
        var rel = ele.data('rel') || '',
            form = ele.closest('form'),
            hidden = form.find('input[name=cmd]');

        if (!hidden.length) {
            hidden = $('<input name="cmd" type="hidden" />').appendTo(form);
        }
        hidden.val(rel);
        form.submit();
    }).cmd('form.confirm', function (ele) {
        var rel = ele.data('rel') || '',
            form = ele.closest('form'),
            msg = ele.data('msg') || 'Are you sure?',
            hidden = form.find('input[name=cmd]');

        if (!hidden.length) {
            hidden = $('<input name="cmd" type="hidden" />').appendTo(form);
        }

        // todo improve confirm box, it's ugly
        if (window.confirm(msg)) {
            hidden.val(rel);
            form.submit();
        }
    })
});