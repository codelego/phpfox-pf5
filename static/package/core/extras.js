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

    Core.cmd('go.back', function () {
        window.history.go(-1);
    }).cmd('form.cancel', function (btn, evt) {
        if (btn.closest('.ibox').length) {
            $(document).trigger('modal.close');
            evt.preventDefault();
            return false;
        }
    });
});