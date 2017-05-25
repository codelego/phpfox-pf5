define(['jquery', 'underscore', 'core'], function () {
    var Core = require('core'),
        _ = require('underscore'),
        $ = require('jquery');

    /**
     * modal Constructor
     * @private
     */
    var Dialog = function (opts) {
        opts = $.extend({
            data: {},
            type: 'modal',// modal, alert, confirm, prompt
            size: 'sm', // options xs, sm, md, lg, xl
            url: false, // url of remote data
            target: false, // target element
            triggerOverlay: false, // hide when click on overlay ?,
            triggerClose: true, // show close icon on header
        }, opts);

        var tpl = '<div class="ibox ibox-modal ibox-<%= size %>">' +
                '<div class="ui-overlay"></div>' +
                '<div class="ibox-loading"><p></p></div>' +
                '<div class="ibox-dialog" role="document">' +
                '<div class="ibox-content">' +
                '</div></div>',
            close = '<button type="button" class="ibox-close" data-cmd="modal.close" aria-label="Close"><span aria-hidden="true">×</span></button>',
            container = $(_.template(tpl)({type: opts.type, size: opts.size})).appendTo('body'),
            loading = $('.ibox-loading', container),
            dialog = $('.ibox-dialog', container),
            content = $('.ibox-content', container)
        ;

        if (opts.triggerOverlay) {
            $('.ui-overlay', container).on('click', function () {
                $('body').removeClass('modal-open');
                container.remove();
            });
        }

        $(document).one('modal.close', function () {
            container.remove();
        });

        if (opts.url) {
            $.ajax({
                url: opts.url,
                type: 'get',
                data: opts.data,
                dataType: 'json',
                headers: {requestType: 'content'}
            }).done(function (data) {
                if (_.isString(data.redirect)) {
                    $(document).trigger('modal.close');
                    Core.loadPage(data.redirect);
                }
                content.html(data.content);
                loading.animate({opacity: 0}, 50);
                dialog.animate({opacity: 1}, 100, function () {
                    content.animate({opacity: 1}, 100);
                });
                if (opts.triggerClose) {
                    $(_.template(close)({})).appendTo(content);
                }
            });
        }
    };

    var Confirm = function (opts, yes_cb) {
        opts = $.extend({
            title: '',
            size: 'xs',
            message: 'Are you sure ?',
            yes: 'OK',
            no: 'Cancel'
        }, opts || {});

        var tpl = '<div class="ibox ibox-confirm ibox-<%= size %>">' +
                '<div class="ui-overlay"></div>' +
                '<div class="ibox-dialog" role="document">' +
                '<div class="ibox-content"><div class="panel panel-default">' +
                '<div class="panel-heading"><%= title %></div>' +
                '<div class="panel-body"><%= message %></div>' +
                '<div class="panel-footer">' +
                '<button class="btn btn-default btn-no"><%= no %></button> ' +
                '<button class="btn btn-danger btn-yes"><%= yes %></button> ' +
                '</div>' +
                '</div></div>',
            container = $(_.template(tpl)(opts)),
            dialog = $('.ibox-dialog', container),
            content = $('.ibox-content', container)
        ;

        if (_.isEmpty(opts.title)) {
            $('.panel-heading', container).remove();
        }
        container.appendTo('body');

        $('.btn-no', container).click(function () {
            container.remove();
        });

        $('.btn-yes', container).click(function () {
            container.remove();
            yes_cb();
        });

        dialog.animate({opacity: 1}, 100, function () {
            content.animate({opacity: 1}, 100);
        });
    };

    var Alert = function (opts) {
        opts = $.extend({
            title: '',
            size: 'xs',
            message: 'Are you sure ?',
            yes: 'OK'
        }, opts || {});

        var tpl = '<div class="ibox ibox-alert ibox-<%= size %>">' +
                '<div class="ui-overlay"></div>' +
                '<div class="ibox-dialog" role="document">' +
                '<div class="ibox-content"><div class="panel panel-default">' +
                '<div class="panel-heading"><%= title %></div>' +
                '<div class="panel-body"><%= message %></div>' +
                '<div class="panel-footer">' +
                '<button class="btn btn-danger btn-yes"><%= yes %></button> ' +
                '</div>' +
                '</div></div>',
            container = $(_.template(tpl)(opts)),
            dialog = $('.ibox-dialog', container),
            content = $('.ibox-content', container)
        ;

        if (_.isEmpty(opts.title)) {
            $('.panel-heading', container).remove();
        }
        container.appendTo('body');

        $('.btn-yes', container).click(function () {
            container.remove();
        });

        dialog.animate({opacity: 1}, 100, function () {
            content.animate({opacity: 1}, 100);
        });
    };

    Core.cmd('modal', function (ele) {
        var opts = {
            size: ele.data('size') || 'sm',
            url: ele.data('url') || ele.prop('href'),
            target: ele.data('target')
        }, message = ele.data('confirm') || false;

        if (message) {
            new Confirm({message: message}, function () {
                new Dialog(opts)
            })
        } else {
            new Dialog(opts)
        }
        return false;
    }).cmd('modal.close', function () {
        $(document).trigger('modal.close');
        return false;
    }).cmd('confirm', function (ele) {
        new Confirm(ele.data('confirm'), function () {
            window.location.href = ele.data('url') || ele.prop('href');
        });
        return false;
    });

    Core.dialog = {
        open: function (opts) {
            return new Dialog(opts)
        },
        confirm: function (opts, yes_cb) {
            return new Confirm(opts, yes_cb)
        },
        alert: function (opts) {
            return new Alert(opts);
        }
    };
});