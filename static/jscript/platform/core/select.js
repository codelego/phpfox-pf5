define(['jquery', 'platform/core/core'], function ($, $kd) {
    $kd.action('select-option', function (element) {
        var control = element.closest('.dropdown'),
            input = control.find('input.hidden:first'),
            label = control.find('span.txt-label:first');


        // console.log(element.attr('value'), element.attr('label'));
        //
        input.val(element.attr('value'));
        label.text(element.attr('label'));
        element.closest('form').submit();
    });
});