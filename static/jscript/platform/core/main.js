define([
    'jquery',
    'underscore',
    'platform/core/core',
    'platform/core/toast',
    'platform/core/boot',
    'platform/core/option',
    'platform/core/paging',
    'platform/core/photoupload',
    'platform/core/select',
    'platform/core/editor',
    'platform/core/tooltip',
    'platform/core/hyves',
    'platform/core/pushstate',
    'platform/core/jquery.ac',
    'platform/core/jquery.jscroll',
    'platform/core/jquery.mentions.input',
    'platform/core/jquery.placeinput',
    'platform/core/jquery.select',
    'platform/core/jquery.elastic',
    'platform/core/jquery.events.input',
    'platform/core/jquery.serialize'
], function ($, _, $kd, Toast) {
    var _debug = true;

    $.newId = function (prefix, count) {
        if (typeof count == 'undefined') {
            count = 10;
        }
        if (typeof prefix == 'undefined') {
            prefix = '_';
        }

        if (prefix == '') {
            prefix = '_';
        }

        var response = prefix;

        var seek = 'qwertyuiopasdfghjklzxcvbnm';
        var max = seek.length;
        for (var i = 0; i < count; ++i) {
            response += seek.charAt(Math.round(Math.random() * max));
        }
        return response;
    };

    $.fn.eid = function (prefix) {
        if (/undefined/i.test(typeof prefix))prefix = 'e';

        if (!$(this).prop('id')) {
            $(this).prop('id', $.newId(prefix, 8));
        }
        return $(this).prop('id');
    };

    //// extends KEND CORE

    $kd.action('ajax', function (ele, evt) {
        var $this = ele,
            url = $this.data('url'),
            data = $this.data('object');

        evt.preventDefault();

        $kd.ajax(url, data)
            .done(function (result) {
                switch (result.directive) {
                    case 'success':
                        Toast.success(result.message);
                        break;
                    case 'error':
                        Toast.error(result.message);
                        break;
                    case 'warning':
                        Toast.warning(result.message);
                        break;
                    case 'reload':
                        window.location.reload();
                        break;
                }
            });
    }).action('expand', function (ele) {
        var $target = $(ele.data('target'));
        $target.toggleClass('collapse');
    }).action('dismiss', function (e) {
        var url = e.data('url'),
            eid = e.data('eid'),
            closest = e.data('closest') || '.card-wrap',
            object = e.data('object'),
            target = eid ? $(eid).closest(closest) : e.closest(closest);

        console.log(closest);

        target.animate({opacity: 0}, 200, function () {
            target.addClass('hidden');
        });

        if (url)
            $kd.ajax(url, object)
                .done(function (result) {
                    if (!_.isEmpty(result.success))
                        Toast.success(result.success);

                    if (!_.isEmpty(result.error)) {
                        Toast.error(result.error);
                        target.removeClass('hidden');
                    }
                });
    }).action('goback', function (btn) {
        if(btn.closest('.hyves-dialog').length){
            $kd.closeModal();
        }else{
            window.history.back();
        }

    });

    $(document).on('click', '[data-toggle]', function (e) {
        var $this = $(this), key = $this.data('toggle');
        if ($kd.actions.hasOwnProperty(key) && typeof $kd.actions[key] == 'function') {
            $kd.actions[key]($this, e);
        }
    });


    $(document).on('click', '[data-toggle="modal"]', function (e) {
        var btn = $(e.currentTarget),
            url = btn.data('url'),
            obj = btn.data('object');

        $kd.modal(url, obj);
    });

    /**
     * Proxy submit form to ajax form
     */
    $(document).on('submit', '[async]', function (evt) {
        evt.preventDefault();
        var form = $(this),
            data = form.serializeJSON(),
            url = form.data('url'),
            _default = {directive: 'close'}, result = {};

        _debug && console.log('post data url ', url, data);

        $kd.ajax(url, data)
            .always(function () {
                _debug && console.log(arguments)
            })
            .done(function (response) {
                result = $.extend({}, _default, response);
                switch (result.directive) {
                    case 'close':
                        $kd.closeModal();
                        break;
                    case 'update':
                        form.closest('.hyves-stagein')
                            .html(response.html)
                            .bootInit();
                        break;
                    case 'reload':
                        $kd.closeModal();
                        window.location.reload();
                        break;
                }
            });
    });
});