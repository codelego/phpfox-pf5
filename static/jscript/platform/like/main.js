define(['jquery', 'platform/core/core'], function ($, $kd) {
    $kd.action('platform/like/btn', function (ele) {
        var data = {obj: ele.data('obj')},
            stage = ele.closest('.card-activity');

        if (!$kd.authRequired()) return;

        function success(response) {
            ele.text(response.label);
            if (stage.length) {
                if (response.hasSample) {
                    stage.find('.fs-like-sample').html(response.sample).removeClass('hidden');
                }
                else {
                    stage.find('.fs-like-sample').addClass('hidden');
                }
            }
        }

        $kd.ajax('ajax/platform/like/like/toggle', data)
            .done(success);

    }).action('btn-like-add', function (btn) {
        var data = {
            obj: btn.data('obj'),
            context: 'btn'
        };

        btn.prop('disabled', true);

        $kd.ajax('/ajax/platform/like/like/add', data).done(function (result) {
            btn.closest('.btn-like-ow').html(result.html);
        }).error(function (result) {
            console.log(result);
        });
    }).action('btn-like-remove', function (btn) {
        btn.prop('disabled', true);
        $kd.ajax('/ajax/platform/like/like/remove', {
            obj: btn.data('uid'),
            context: 'btn'
        }).done(function (result) {
            btn.closest('.btn-like-ow').html(result.html);
        }).error(function (result) {
            console.log(result);
        });
    }).action('like-comment-toggle', function (btn) {
        var stage = btn.closest('.fs-cm-asset'),
            data = {obj: btn.data('obj')};

        if (!$kd.authRequired()) return;

        function success(response) {
            btn.text(response.label);

            if (stage.length) {
                if (response.sample != "") {
                    stage.find('.cmt-like-samples-ow').removeClass('hidden');
                    stage.find('.cmt-like-samples').html(response.sample);
                }
                else {
                    stage.find('.cmt-like-samples-ow').addClass('hidden');
                    stage.find('.cmt-like-samples').html(response.sample);
                }
            }
        }

        $kd.ajax('ajax/platform/like/like/toggle', data)
            .done(success);

    }).action('membership-like-toggle', function (btn) {
        var data = {obj: btn.data('obj')},
            eid = btn.data('eid');

        if (!$kd.authRequired()) return;

        function success(response) {
            if (eid) {
                $(eid).replaceWith(response.html);
            }
            else {
                btn.replaceWith(response.html);
            }
        }

        $kd.ajax('ajax/platform/like/like/membership-like-toggle', data)
            .done(success);
    });
});