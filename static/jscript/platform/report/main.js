define(['jquery', 'underscore', 'platform/core/core'], function ($, _, $kd) {
    $kd.action('btn-report', function (ele) {
        var data = {obj: ele.data('obj')};

        $kd.modal('ajax/platform/report/report/dialog', data);
    });
});