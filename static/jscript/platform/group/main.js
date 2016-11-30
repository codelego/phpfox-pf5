define(['jquery', 'platform/core/core'], function ($, $kd) {
    $kd.action('btn-group-join', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/group/membership/join', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-group-leave', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/group/membership/leave', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-group-accept', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/group/membership/accept', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-group-ignore', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/group/membership/ignore', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-group-cancel', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/group/membership/cancel', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-group-remove', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/group/membership/remove', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-group-owner-approve', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn', 'owner': btn.data('owner')};

        $kd.ajax('/ajax/platform/group/membership/owner-approve', data)
            .done(function () {
                if (btn.data('eid')) {
                    $(btn.data('eid')).closest('.card-wrap').remove();
                } else {
                    btn.closest('.card-wrap').remove();
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-group-owner-deny', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn', 'owner': btn.data('owner')};

        $kd.ajax('/ajax/platform/group/membership/owner-deny', data)
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