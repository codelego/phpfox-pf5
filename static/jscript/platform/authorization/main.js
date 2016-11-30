define(['jquery', 'platform/core/core'], function ($, $kd) {

    var _debug = true;


    $kd.action('btn-option-privacy', function (option) {
        var btn = $(option.data('eid')),
            data = option.data('privacy'),
            obj = btn.data('object'),
            sendData = $.extend({}, obj, {value: data.value})
            ;

        if (!btn.length) return;

        if (_debug) {
            console.log('update privacy value for button');
            console.log(data);
        }

        if (btn.length) {
            btn.find('span.text').text(data.label);
            btn.find('input.privacy-value').val(data.value);
            btn.find('input.privacy-type').val(data.type);
        }

        $kd.ajax('ajax/platform/authorization/privacy/change-default', sendData)
            .done(function (json) {
                console.log(json);
            });
    }).action('edit-option-privacy', function (option) {
        var btn = $(option.data('eid')),
            data = option.data('privacy'),
            obj = btn.data('object'),
            sendData = $.extend({}, obj, {privacy: {type: data.type, value: data.value, eid: option.data('eid')}})
            ;

        if (!btn.length) return;

        if (_debug) {
            console.log('update privacy value for button');
            console.log(data);
        }

        btn.prop('disabled', true);

        /**
         * update privacy value
         */
        $kd.ajax('ajax/platform/relation/privacy/update-privacy', sendData)
            .always(function () {
                btn.prop('disabled', false);
            }).done(function (response) {
            btn.replaceWith(response.html);
        });
    });
});