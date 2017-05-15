define(['jquery', 'underscore'], function () {

    var Core, commands = [],
        _ = require('underscore');

    //###############################################//
    // configurations
    //###############################################//

    Core = {
        baseUrl: '/pf5/',
        staticUrl: '/pf5/static',
        staticVersion: '',
        cmd: function (cmd, callback) {
            commands[cmd] = callback;
            return this;
        },
        url: function (path, data) {
            var h = '';

            if (typeof data == 'string') {
                h = '?' + data;
            }
            else if (typeof data == 'object') {
                h = '?' + $.param(data);
            }

            return this.baseUrl + path.replace(/^\/+/, '') + h;
        },
        styles: function (styles) {
            var i = 0, length = styles.length, id, head, link;

            head = document.getElementsByTagName('head')[0];

            for (; i < length; ++i) {
                id = 'css_' + sha1(styles[i]);  // you could encode the css path itself to generate id..
                if (!document.getElementById(id)) {
                    link = document.createElement('link');
                    link.id = id;
                    link.rel = 'stylesheet';
                    link.type = 'text/css';
                    link.href = Core.staticUrl + styles[i] + '.css?_=' + Core.staticVersion;
                    link.media = 'all';
                    head.appendChild(link);
                }
            }
            return this;
        },
        xtarget: function (path, $dom) {
            var i, arr = path.replace('//', '@').split('/');
            for (i in arr) {
                switch (arr[i].charAt(0)) {
                    case ':':
                        $dom = $dom.closest(arr[i].substr(1));
                        break;
                    case '@':
                        $dom = $(arr[i].substr(1));
                        break;
                    default:
                        $dom = $dom.find(arr[i]);
                }
            }
            return $dom;
        }
    };


    //###############################################//
    // methods
    //###############################################//


    Core.ajaxForm = function (form) {
        var indicator = '.sending-indicator';
        return $.ajax({
            url: form.data('url') || form.prop('action'),
            method: 'POST',
            // dataType: 'json',
            data: form.serializeJSON(),
            beforeSend: function () {
                form.addClass('disabled sending');
                $(indicator).removeClass('hide');
            }
        }).always(function () {
            form.removeClass('disabled sending');
            $(indicator).addClass('hide');
        });
    };


    $(document).on('click', '[data-cmd]', function (evt) {
        var ele = $(this),
            name = ele.data('cmd');

        if (commands.hasOwnProperty(name)
            && typeof commands[name] == 'function') {
            return commands[name](ele, evt);
        }
    }).on('submit', '[data-submit]', function (evt) {
        var form = $(this),
            name = form.data('submit');

        // prevent event
        if (form.hasClass('disabled')) {
            evt.preventDefault();
            return false;
        }

        if (commands.hasOwnProperty(name)
            && typeof commands[name] == 'function') {
            return commands[name](form, evt);
        }
    });
    return Core;
});