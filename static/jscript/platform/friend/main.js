define(['jquery', 'platform/core/core'], function ($, $kd) {
    $kd.action('btn-friend-request', function (btn) {
        var data = {obj: btn.data('obj')};

        btn.prop('disabled', true);

        $kd.ajax('/ajax/platform/friend/friend/request', data)
            .always(function () {
                btn.prop('disabled', false)
            }).done(function (response) {
            btn.closest('.btn-membership').replaceWith(response.html);
        });
    }).action('btn-friend-ignore', function (btn) {
        var data = {obj: btn.data('obj')},
            eid = btn.data('eid');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/platform/friend/friend/deny', data)
            .always(function () {
                btn.prop('disabled', false)
            }).done(function (response) {
            $(eid).replaceWith(response.html);
        });
    }).action('btn-friend-accept', function (btn) {
        var data = {obj: btn.data('obj')},
            eid = btn.data('eid');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/platform/friend/friend/accept', data)
            .always(function () {
                btn.prop('disabled', false)
            }).done(function (response) {
            $(eid).replaceWith(response.html);
        });
    }).action('btn-friend-cancel', function (btn) {
        var data = {obj: btn.data('obj')};

        btn.prop('disabled', true);

        $kd.ajax('/ajax/platform/friend/friend/cancel', data)
            .always(function () {
                btn.prop('disabled', false)
            }).done(function (response) {
            btn.closest('.btn-membership').replaceWith(response.html);
        });
    }).action('btn-friend-remove', function (btn) {
        var data = {obj: btn.data('obj')},
            eid = btn.data('eid');

        btn.prop('disabled', true);

        $kd.ajax('/ajax/platform/friend/friend/remove', data)
            .done(function (response) {
                $(eid).replaceWith(response.html);
            });
    });
});