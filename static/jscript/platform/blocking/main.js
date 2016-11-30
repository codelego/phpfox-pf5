define(['jquery', 'platform/core/core'], function ($, $kd) {
    $kd.action('btn-blocking-toggle', function (btn) {
        var data = $.extend({}, {obj: btn.data('obj'), ctx: btn.hasClass('btn') ? 'btn' : 'menu'});

        btn.prop('disabled', false);

        $kd.ajax('ajax/platform/blocking/block/toggle', data)
            .done(function (res) {
                btn.closest('.btn-blocking').replaceWith(res.html);
            }).always(function () {
            btn.prop('disabled', false);
        });
    })
});