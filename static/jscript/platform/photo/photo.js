define(['jquery', 'platform/core/core'], function ($, $kd) {

    $kd.action('photo-make-album-cover', function (ele) {
        var data = {
            obj: ele.data('obj')
        };

        $kd.ajax('ajax/platform/photo/photo/make-album-cover', data)
            .done(function (response) {
                if (response.message) {
                    Toast.success(response.message);
                }
            });
    }).action('btn-photo-delete', function (ele) {
        var data = {
                obj: ele.data('obj')
            },
            eid = ele.data('eid'),
            wrap = $(eid).closest('.card-wrap');

        wrap.animate({opacity: 0}, 200, function () {
            wrap.remove()
        });

        $kd.ajax('ajax/platform/photo/photo/delete-photo', data)
            .done(function (response) {
                if (response.message) {
                    Toast.success(response.message);
                }
            })
    }).action('photo-make-profile-photo', function (ele) {
        var data = {
            obj: ele.data('obj')
        };

        $kd.modal('ajax/platform/photo/avatar/edit-avatar-dialog', data);
    });
});