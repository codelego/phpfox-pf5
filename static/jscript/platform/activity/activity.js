/**
 * Activity Feed Javascript component
 * @author Nam Nguyen
 * @project Picaso
 * @version 1.0.1
 */

define(['jquery', 'platform/core/core'], function ($, $kd) {

    var _debug = false;

    $kd.action('fc-btn-submit', function (btn) {
        btn.closest('form').trigger('submit');
    }).action('btn-remove-blocking', function (btn) {
        var data = btn.data('object');
        $kd.ajax('ajax/platform/core/block/remove', data)
            .done(function (response) {
                _debug && console.log(response);
            });
    }).action('fc-btn-location', function (ele) {
        var $f = ele.closest('form');
        $f.find('.fc-att-location').removeClass('hidden');
        $f.find('.fc-att-people').addClass('hidden');
        $f.find('.fc-att-location-input').focus();
    }).action('fc-btn-people', function (ele) {
        ele.closest('form').find('.fc-att-people').removeClass('hidden');
        ele.closest('form').find('.fc-att-people-input').focus();
    }).action('fc-btn-photo', function (ele) {
        var form = ele.closest('form'),
            target = ele.data('target');

        _debug && console.log(target, $(target, form), this);

        form.find('.fc-att-row').addClass('hidden');
        form.find('.fc-att-photo').removeClass('hidden');
        // process photo build
        $(target, form).trigger('click');
    }).action('placeinput', function (ele) {
        if (!ele.data('placeinput')) {
            ele.data('placeinput', new PlaceInput(ele));
        }
    }).action('tag-people', function (ele) {

        if (ele.data('tagsinput', false)) {
            return false;
        }
        ele.data('tagsinput', new TagsInput(ele, {}));
    }).action('btn-activity-loadmore', function (ele) {
        ele.closest('.activity-stream')
            .trigger('loadmore');
    }).action('btn-remove-activity', function (ele) {
        var outer = ele.closest('.fs-ow'),
            data = {
                id: ele.data('obj'),
                eid: ele.data('eid')
            };

        outer.hide();

        $kd.ajax('ajax/platform/activity/activity/remove', data)
            .done(function (response) {

            });
    }).action('activity-remove', function (ele) {
        var data = {
                id: ele.data('obj'),
                eid: ele.data('eid')
            },
            outer = $(data.eid).closest('.card-activity');

        _debug && console.log(outer);

        outer.animate({opacity: 0}, 500, function () {
            outer.hide()
        });

        $kd.ajax('ajax/platform/activity/activity/remove', data)
            .done(function (response) {

            });
    }).action('activity-open-privacy', function (ele) {
        var data = {
                id: ele.data('obj'),
                eid: ele.data('eid')
            },
            outer = $(data.eid).closest('.card-activity').find('.privacy-label:first');

        if (outer.length)
            outer.trigger('click');
    }).action('activity-hide', function (ele) {
        var data = {
                id: ele.data('obj'),
                eid: ele.data('eid')
            },
            outer = $(data.eid).closest('.card-activity');

        outer.animate({opacity: 0}, 500, function () {
            outer.hide()
        });

        if (ele.prop('disabled')) return;

        ele.prop('disabled', true);

        $kd.ajax('ajax/platform/activity/activity/toggle-hidden', data)
            .always(function () {
                ele.prop('disabled', false)
            }).done(function (response) {
            _debug && console.log(response);
            ele.html(response.html);
        });
    }).action('activity-hide-timeline', function (ele) {
        var data = {
                id: ele.data('obj'),
                eid: ele.data('eid')
            },
            outer = $(data.eid).closest('.card-activity');

        outer.animate({opacity: 0}, 500, function () {
            outer.hide()
        });

        if (ele.prop('disabled')) return;

        ele.prop('disabled', true);

        $kd.ajax('ajax/platform/activity/activity/toggle-hide-timeline', data)
            .always(function () {
                ele.prop('disabled', false)
            }).done(function (response) {
            _debug && console.log(response);
            ele.html(response.html);
        });
    }).action('activity-edit-submit', function (ele) {
        var form = ele.closest('form'),
            data = form.serializeJSON(),
            outer = form.closest('.fs-story-ow');

        if (form.prop('disabled'))
            return;

        $('.mentions-input', form).mentionsInput('val', function (text) {
            data.statusTxt = text;
        });

        _debug && console.log(data);

        form.prop('disabled', true);

        $kd.ajax('ajax/platform/activity/activity/save-inline-edit', data)
            .always(function () {
                form.prop('disabled', false);
            }).done(function (response) {
            _debug && console.log(response);
            outer.html(response.html);
        });
    }).action('activity-edit-cancel', function (ele) {
        var form = ele.closest('form'),
            data = form.serializeJSON(),
            outer = form.closest('.fs-story-ow');

        _debug && console.log(data);

        if (form.prop('disabled'))
            return;

        form.prop('disabled', true);

        $kd.ajax('ajax/platform/activity/activity/cancel-inline-edit', data)
            .always(function () {
                form.prop('disabled', false);
            }).done(function (response) {
            _debug && console.log(response);
            outer.html(response.html);
        });
    }).action('activity-subscribe', function (ele, evt) {
        var data = {
            id: ele.data('obj'),
            eid: ele.data('eid')
        };

        if (ele.prop('disabled')) return;

        ele.prop('disabled', true);

        evt.preventDefault();

        $kd.ajax('ajax/platform/activity/activity/toggle-subscribe', data)
            .always(function () {
                ele.prop('disabled', false)
            }).done(function (response) {
            _debug && console.log(response);
            ele.html(response.html);
        });
    }).action('edit-activity-status', function (btn) {
        var data = {
                id: btn.data('obj'),
                eid: btn.data('eid'),
            },
            $element = $('[data-id="' + data.id + '"]'),
            stage = $element.find('.fs-story-ow');

        if (!stage.length)
            stage = $('<div class="fs-story-ow">').insertAfter($element.find('.fs-headline-ow'));

        $kd.ajax('ajax/platform/activity/activity/edit-inline', data)
            .done(function (response) {
                stage.html(response.html)
                    .removeClass('hidden')
                    .find('textarea').mentionsInput({});
            });
    })
});