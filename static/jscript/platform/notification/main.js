define(['jquery', 'platform/core/core'], function ($, $kd) {
    $kd.action('btn-request-accept', function (btn, evt) {
        var data = $.extend({}, {obj: btn.data('obj'), ctx: btn.data('ctx')});

        evt.preventDefault();

        btn.prop('disabled', true);

        btn.closest('.card-invitation').addClass('hidden');

        $kd.ajax('ajax/platform/notification/request/accept', data)
            .always(function () {
                btn.prop('disabled', false);
            }).done(function (result) {
            }
        ).error(function () {
        });
    }).action('btn-request-deny', function (btn, evt) {
        var data = $.extend({}, {obj: btn.data('obj'), ctx: btn.data('ctx')});

        evt.preventDefault();

        btn.prop('disabled', true);

        btn.closest('.card-invitation').addClass('hidden');

        $kd.ajax('ajax/platform/notification/request/deny', data)
            .always(function () {
                btn.prop('disabled', false);
            }).done(function (result) {
            }
        ).error(function () {
        });
    });
});