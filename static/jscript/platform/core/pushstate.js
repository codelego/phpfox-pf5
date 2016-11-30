define(['jquery', 'underscore'], function ($, _) {
    var _debug = false,
        defaultContainer = '#site-container',
        container = null,
        _iframe = null,
        onStart = function () {
            $(document).trigger('page_change_start');
            $('.navbar-collapse').removeClass('in'); // collapse menu
        },
        onLoadComplete = function (response) {
            if (response.directive == '') {

            } else {
                $(container).html(response.html);
                document.title = response.title;
                window.scrollTo(0, 0);
            }
        },
        loadPage = function (url, toitem) {
            // remove old loading data
            if (_iframe)
                _iframe.prop('src', 'javascript:false;').remove();

            if (/undefined/i.test(typeof toitem))
                toitem = defaultContainer;

            container = toitem;

            _debug && console.log('load page ', url, container);

            url += (url.indexOf('?') == -1 ? '?' : '&') + '__ajax_load_page=1&t_' + $.now();

            onStart();

            _iframe = $('<iframe />', {src: url})
                .css({display: 'none'})
                .appendTo('body');

            _iframe.on('load', function () {
                _iframe.prop('src', 'javascript:false');
                _iframe.remove();
                _iframe = null;
            });
        },
        fetchPage = function (href) {
            window.history.pushState({}, '', href);
            loadPage(href, defaultContainer);
        }, replacePage = function (href) {
            window.history.replaceState({}, '', href);
            loadPage(href, defaultContainer);
        };

    $(window).on("popstate", function (e) {
        if (e.originalEvent.state !== null) {
            loadPage(location.href, defaultContainer);
        }
    });

    /**
     * bind pajax
     * noope click
     */
    $(document).on('click', 'a', function (evt) {


        var ele = $(evt.currentTarget),
            href = ele.attr('href'),
            target = ele.prop('target'),
            toggle = ele.data('toggle'),
            onclick = ele.prop('onclick'),
            container = ele.prop('container') || defaultContainer;

        // todo fix issues go to another domain
        if (typeof href == 'undefined') return;
        // check go to another domain.
        // if (href.indexOf(document.domain) > -1) return;
        if (href.indexOf('javascript') > -1) return;
        if (href.trim() == '') return;
        if (toggle) return;
        if (target) return;
        if (onclick) return;

        _debug && console.log('load page ', href, container);

        // how to test this case.
        //if (document.location.href.indexOf(href) > -1) return false;

        evt.preventDefault();

        window.history.pushState({}, '', href);

        loadPage(href, container);
    });

    // Unmarshals an Uint8Array to string.
    window.loadPage = loadPage;
    window.fetchPage = fetchPage;
    window.replacePage = replacePage;
    window.onFetchPageComplete = onLoadComplete;
});