define(['jquery', 'platform/core/core'], function ($, $kd) {
    $kd.action('btn-event-join', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/event/membership/join', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-event-leave', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/event/membership/leave', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-event-accept', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/event/membership/accept', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-event-ignore', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/event/membership/ignore', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-event-cancel', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/event/membership/cancel', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-event-remove', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/event/membership/remove', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-event-owner-approve', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn', 'owner': btn.data('owner')};

        $kd.ajax('/ajax/platform/event/membership/owner-approve', data)
            .done(function () {
                if (btn.data('eid')) {
                    $(btn.data('eid')).closest('.card-wrap').remove();
                } else {
                    btn.closest('.card-wrap').remove();
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-event-owner-deny', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn', 'owner': btn.data('owner')};

        $kd.ajax('/ajax/platform/event/membership/owner-deny', data)
            .done(function () {
                if (btn.data('eid')) {
                    $(btn.data('eid')).closest('.card-wrap').remove();
                } else {
                    btn.closest('.card-wrap').remove();
                }
            }).error(function (result) {
            console.log(result);
        });
    });
});