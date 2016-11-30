define(['jquery', 'platform/core/core'], function ($, $kd) {

    $kd.action('btn-follow-toggle', function (btn) {
        var data = {obj: btn.data('obj'), ctx: btn.hasClass('btn') ? 'btn' : 'menu'};

        if (btn.prop('disabled')) return;

        btn.prop('disabled', true);

        $kd.ajax('ajax/platform/follow/follow/toggle', data)
            .done(function (res) {
                btn.closest('.btn-follow').replaceWith(res.html);
            }).always(function () {
            btn.prop('disabled', false);
        });
    }).action('link-follow-toggle', function (ele, evt) {
        var data = {obj: ele.data('obj')};
        evt.preventDefault();
        if (ele.prop('disabled')) return;
        ele.prop('disabled', true);
        $kd.ajax('ajax/platform/follow/follow/link-toggle', data)
            .always(function () {
                ele.prop('disabled', false)
            }).done(function (response) {
            ele.html(response.html);
        });
    });
});