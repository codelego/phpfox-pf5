define([
    'jquery',
    'underscore',
    'package/jquery/jquery.serialize',
    'package/jquery/jquery.toast',
    'package/core/history',
    'package/core/sha1',
    'package/core/dropdown',
    'package/core/dialog',
    'package/core/moderator',
    // 'package/core/history'
], function () {
    var Core = require('core');

    Core.cmd('go.back', function () { // history go back
        window.history.go(-1);
    }).cmd('form.cancel', function (btn, evt) { // apply form cancel
        if (btn.closest('.ibox').length) {
            $(document).trigger('modal.close');
            evt.preventDefault();
            return false;
        }
    }).cmd('toggle', function (btn, evt) { // apply toggle class
        var prop = btn.data('target').split(';'),
            dom = Core.xtarget(btn,prop[0]);
        dom.toggleClass((prop.length > 1 ? prop[1] : 'hide').replace('.', ' '));
        evt.preventDefault();
        return false;
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