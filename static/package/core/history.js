define(['jquery', 'core'], function () {
    var Core = require('core'),
        $ = require('jquery'),
        _lastHref = location.href,
        _lastXhr = null,
        _defaults = {
            replaceUrl: true,
            target: "#layout_containers",
            direction: "right",
            async: true,
            showLoadingBar: true,
            cache: true,
            global: true,
            headers: {},
            statusCode: {},
            type: 'get',
            dataType: 'json',
            data: {},
            requestType: 'update_page'
        };

    var loadingBar = {
        element: false,
        start: function () {
            $('.loading-bar').remove();
            this.element = $('<div class="loading-bar waiting"><dt/><dd/></div>').appendTo('body');
            this.element.width((50 + Math.random() * 30) + "%");
        },
        complete: function () {
            if (this.element) {
                this.element.width("101%").delay(200).fadeOut(400, function () {
                    $(this).remove();
                });
            }
        }
    };

    Core.loadPage = function (href, options) {
        var settings = $.extend({}, _defaults, options),
            target = $(settings.target),
            headers = $.extend(settings.headers, {requestType: settings.requestType});

        // 1. check state is support
        if (!window.history.replaceState) {
            window.location.href = href;
        }

        //2. check duplicat state
        if (_lastHref != href && settings.replaceUrl) {
            window.history.pushState({}, href, href);
            console.log('push to history state', href);
        }
        _lastHref = href;

        if (_lastXhr && _lastXhr.abort()) {

        }

        $(document).trigger('ajax.load.start');

        //3. send ajax request, return prefer object
        _lastXhr = $.ajax({
            type: settings.type,
            data: settings.data,
            url: href,
            async: settings.async,
            cache: settings.cache,
            global: settings.global,
            headers: headers,
            statusCode: settings.statusCode,
            dataType: settings.dataType,
            beforeSend: function () {
                if (settings.showLoadingBar) loadingBar.start();
            }
        }).always(function () {
            if (settings.showLoadingBar) loadingBar.complete();
            $(document).trigger('ajax.load.end');
        }).done(function (data) {
            if (typeof data.redirect != 'undefined') {
                Core.loadPage(data.redirect, {});
                return;
            } else {
                $(target).html(data.content);
            }

            if (data.meta) {
                $('title').text(data.meta.title);
                $('meta[name="description"]').text(data.meta.description);
                $('meta[name="keywords"]').text(data.meta.keywords);
            }
        });
    };

    $(window).on("popstate", function (e) {
        if (e.originalEvent.state !== null) {
            Core.loadPage(location.href, {replaceUrl: false});
        }
    });

    $(document).on('submit', 'form', function (evt) {
        var form = $(this),
            method = form.prop('method').toString().toLowerCase(),
            action = form.prop('action'),
            data = form.serializeJSON,
            isModal = form.closest('.ibox-content').length > 0,
            target = false;

        if (isModal) {
            target = form.closest('.ibox-content');
        }

        // request with modal


        // request in full page.

        if (isModal) {
            // form with search.
            if (method == 'get') {
                evt.preventDefault();
                Core.loadPage(action, {data: data, type: method, requestType: 'FAL'});
                return false;
            }
            if (method == 'post') {
                evt.preventDefault();

                $.ajax({
                    url: action,
                    type: 'post',
                    dataType: 'json',
                    data: form.serializeJSON(),
                    headers: {requestType: 'update_content'}
                }).done(function (data) {
                    if(_.isString(data.redirect)){
                        Core.loadPage(data.redirect,{});
                        $(document).trigger('modal.close');
                    }
                    if(_.isEmpty(data.content)){
                        $(document).trigger('modal.close');
                    }
                });

                return false;
            }
        }
    });

    $(document).on('click', 'a', function (evt) {
        var link = $(this),
            href = link.prop('href') || link.data('url'),
            target = link.prop('target'),
            toggle = link.data('toggle'),
            cmd = link.data('cmd'),
            onclick = link.prop('onclick');

        // 1. check control + click to new page.
        if (evt.metaKey || evt.ctrlKey || evt.altKey) return true;

        // 2. link has 'no-ajax' class
        if (link.hasClass('no-ajax')) return true;

        // todo fix issues go to another domain
        if (typeof href == 'undefined') return true;
        // 3. check go to another domain.
        // if (href.indexOf(document.domain) > -1) return;

        // 4. ajax type
        if (href.indexOf('javascript') > -1) return;

        // 5. empty href
        if (href.trim() == '') return;

        // 6. has toggle, target or onclick
        if (toggle || target || onclick || cmd) return true;

        evt.preventDefault();

        Core.loadPage(href);

        return false;
    });

    window.Core = Core;
});