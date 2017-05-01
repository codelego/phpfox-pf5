define(['jquery', 'package/core/extras'], function () {

    var main = {}, commands=[], _ = require('underscore');

    //###############################################//
    // configurations
    //###############################################//

    main.baseUrl = '/pf5/';
    main.staticUrl = '/pf5/static/';
    main.staticVersion = '';

    //###############################################//
    // methods
    //###############################################//

    main.cmd = function (cmd, callback) {
        commands[cmd] = callback;
        return this;
    };

    $.ajaxForm = function (form) {
        if (form.hasClass('disabled')) {
            return false;
        }

        var indicator = '.sending-indicator';

        return $.ajax({
            url: form.data('url'),
            method: 'POST',
            dataType: 'json',
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

    /**
     * @param {string} path
     * @param {string|object} data
     * @returns {string}
     */
    main.url = function (path, data) {
        var h = '';

        if (typeof data == 'string') {
            h = '?' + data;
        }
        else if (typeof data == 'object') {
            h = '?' + $.param(data);
        }

        return this.baseUrl + path.replace(/^\/+/, '') + h;
    };

    /**
     * @param {string[]} styles
     * @returns {main}
     */
    main.styles = function (styles) {
        var i = 0, length = styles.length, id, head, link;

        head = document.getElementsByTagName('head')[0];

        for (; i < length; ++i) {
            id = 'css_' + sha1(styles[i]);  // you could encode the css path itself to generate id..
            if (!document.getElementById(id)) {
                link = document.createElement('link');
                link.id = id;
                link.rel = 'stylesheet';
                link.type = 'text/css';
                link.href = main.staticUrl + styles[i] + '.css?_=' + main.staticVersion;
                link.media = 'all';
                head.appendChild(link);
            }
        }
        return this;
    };

    //###############################################//
    // register commands
    //###############################################//
    main.cmd('toggle', function (btn) {
        var prop = btn.data('rel').split(':'),
            rel = prop[0].split('|'),
            classes = prop[1];

        switch (rel.length) {
            case 0:
                btn.toggleClass(classes);
                break;
            case 2:
                if (rel[1] != '') {
                    btn.closest(rel[0])
                        .find(rel[1])
                        .toggleClass(classes);
                } else {
                    btn.closest(rel[0])
                        .toggleClass(classes);
                }
                break;
            case 1:
                $(rel[0]).toggleClass(classes);
                break;
            case 3:

        }
    }).cmd('form.cmd', function (ele) {
        var rel = ele.data('rel') || '',
            form = ele.closest('form'),
            hidden = form.find('input[name=cmd]');

        if (!hidden.length) {
            hidden = $('<input name="cmd" type="hidden" />').appendTo(form);
        }
        hidden.val(rel);
        form.submit();
    }).cmd('form.confirm', function (ele) {
        var rel = ele.data('rel') || '',
            form = ele.closest('form'),
            msg = ele.data('msg') || 'Are you sure?',
            hidden = form.find('input[name=cmd]');

        if (!hidden.length) {
            hidden = $('<input name="cmd" type="hidden" />').appendTo(form);
        }

        // todo improve confirm box, it's ugly
        if (window.confirm(msg)) {
            hidden.val(rel);
            form.submit();
        }
    });

    //###############################################//
    // register events
    //###############################################//

    $(document).on('click', '[data-cmd]', function (evt) {
        var ele = $(this),
            name = ele.data('cmd');

        if (!commands.hasOwnProperty(name))
            return false;

        if (typeof commands[name] != 'function')
            return false;

        evt.stopPropagation();

        commands[name](ele, evt);

        return false;
    }).on('core.moderator.check_all', function () {
        $('input.item_checkbox').prop('checked', true)
    }).on('core.moderator.uncheck_all', function () {
        $('input.item_checkbox').prop('checked', false)
    }).on('change', '.moderation-check-all', function () {
        var ele = $(this),
            checked = ele.prop('checked');
        ele.prop('checked', checked ? true : false);
        $(document).trigger(ele.prop('checked')?'core.moderator.check_all':'core.moderator.uncheck_all');
    }).on('change','.item_checkbox',function(){

    }).on('submit', '[data-submit]', function (evt) {
        var ele = $(this),
            name = ele.data('submit');

        if (!commands.hasOwnProperty(name) || typeof commands[name] != 'function')
            return false;

        evt.preventDefault();

        commands[name](ele, evt);

        return false;
    });

    window.main = main;

    return main;
});