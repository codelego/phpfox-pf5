/**
 * @author Nam Nguyen <nam.ngvan@gmail.com>
 * handle th, td dropdown
 * do not use bootstrap dropdown because table & overflow: hidden issues.
 * must post item into corner
 */
define(['jquery', 'underscore', 'core'], function () {

    var Core = require('core'),
        debug = true;

    var DropDown = function (element) {
        var offset = element.offset(),
            url = element.data('url') || element.prop('href'),
            target = element.data('target'),
            id = 'id_td_dropdown',
            container = $('<div class="fly-dropdown"></div>'),
            content = $('<div class="dropdown open"/>'),
            size = {
                width: 200,
                height: 250
            },
            css = {
                left: offset.left,
                top: offset.top
            },
            extras = {
                right: offset.left > window.innerWidth - size.height,
                up: offset.top > $(document).height() - size.height
            };

        console.log(extras);

        if (extras.right) {
            content.addClass('dropdown-right');
            css.left += element.outerWidth();
        }

        if (extras.up) {
            content.addClass('dropup');
            css.top += element.outerHeight();
        }

        if (url) {
            content.load(url);
        } else if (target) {
            var obj = Core.xtarget(element, target);
            if (obj.length) {
                content.html(obj.clone().removeClass('hide').addClass('dropdown-menu'));
            }
        } else {
            content.html($('ul', element)
                .clone()
                .removeClass('hide')
                .addClass('dropdown-menu'));
        }

        $('#' + id).remove();

        container.prop('id', id).appendTo('body').css(css).addClass('in');

        content.appendTo(container);

        $('ul', container).hover(function () {
        }, function () {
            container.remove();
        });
    };

    $(document).on('ajax.load.start', function () {
        $('#id_td_dropdown').remove();
    });

    Core.cmd('dropdown', function (ele) {
        new DropDown(ele);
    });
});