define(['jquery', 'platform/core/core'], function ($, $kd) {

    $kd.action('btn-comment-remove', function (ele) {
        var data = {obj: ele.data('obj')},
            eid = ele.data('eid'),
            stage = $(eid).closest('.cmt-item');

        if (!$kd.authRequired()) return;

        stage.animate({opacity: 0}, 500, function () {
            stage.addClass('hidden')
        });

        ele.prop('disabled');

        $kd.ajax('ajax/platform/comment/comment/remove', data)
            .always(function () {
                ele.prop('disabled', false)
            })
            .done(function (response) {
                if (response.code != 200) {
                    stage.removeClass('hidden').animate({opacity: 1});
                }
            });
    }).action('btn-comment-edit', function (ele) {
        var data = ele.data(),
            eid = ele.data('eid');

        if (!$kd.authRequired()) return;

        $kd.ajax('ajax/platform/comment/comment/inline-edit', data)
            .done(function () {
            });
    }).action('btn-comment', function (ele) {
        var stage = ele.closest('.activity-item'),
            form = stage.find('.fs-cmf-ow');

        if (!$kd.authRequired()) return;

        form.removeClass('hidden');
        form.find('.fc-mention-input').focus();

    }).action('btn-comment-more', function (ele) {
        var loading = ele.data('loading'),
            obj = {obj: ele.data('obj')},
            stage = ele.closest('.card-footer'),
            cmts = stage.find('.cmt-item'),
            parent = ele.closest('div'),
            ids = [];

        if (loading) return;

        cmts.each(function (i, e) {
            var id = $(e).data('id');
            if (!/undefined/.test(id))ids.push(id)
        });

        var sendData = $.extend({}, obj, {excludes: ids});
        // how to exclude exists data
        ele.data('loading', true);

        $kd.ajax('ajax/platform/comment/comment/view-more', sendData)
            .done(function (response) {
                if (response.html == "") {
                    ele.closest('div').addClass('hidden');
                } else {
                    $(response.html).insertBefore($('.cmt-item:first', stage));
                    var total = response.commentCount,
                        counter = $('.cmt-item', stage).length,
                        cmds = $(response.cmds);

                    $('.counter', cmds).text(counter);

                    if (total == counter) {
                        ele.closest('div').addClass('hidden');
                    }

                    parent.html(cmds);
                }
            })
            .complete(function () {
                ele.data('loading', false);
            })
            .error();
    });
});