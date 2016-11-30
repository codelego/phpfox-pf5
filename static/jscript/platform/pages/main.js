define(['jquery', 'platform/core/core'], function ($, $kd) {
    $kd.action('btn-pages-join', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/pages/membership/join', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-pages-leave', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/pages/membership/leave', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-pages-accept', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/pages/membership/accept', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-pages-ignore', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/pages/membership/ignore', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-pages-cancel', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/pages/membership/cancel', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-pages-remove', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn'};

        $kd.ajax('/ajax/platform/pages/membership/remove', data)
            .done(function (result) {
                if (btn.data('eid')) {
                    $(btn.data('eid')).replaceWith(result.html)
                } else {
                    btn.replaceWith(result.html)
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-pages-owner-approve', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn', 'owner': btn.data('owner')};

        $kd.ajax('/ajax/platform/pages/membership/owner-approve', data)
            .done(function () {
                if (btn.data('eid')) {
                    $(btn.data('eid')).closest('.card-wrap').remove();
                } else {
                    btn.closest('.card-wrap').remove();
                }
            }).error(function (result) {
            console.log(result);
        });
    }).action('btn-pages-owner-deny', function (btn) {
        var data = {obj: btn.data('obj'), context: 'btn', 'owner': btn.data('owner')};

        $kd.ajax('/ajax/platform/pages/membership/owner-deny', data)
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