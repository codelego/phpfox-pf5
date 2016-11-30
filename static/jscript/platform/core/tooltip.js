define(['jquery'], function ($) {
    var debug = true,
        MyTooltip;

    /**
     * @constructor
     */
    MyTooltip = function () {
        var dialog,
            dialogContent,
            dialogArrow,
            mouseOverTimeout = 400,
            mouseOverTimeoutId = 0,
            mouseLeaveTimeout = 100,
            mouseLeaveTimeoutId = 0,
            element;

        /**
         * create dialog one.
         */
        function createTooltip() {
            if (dialog) return;
            dialog = $('<div class="dialog-tooltip top"/>').appendTo('body');
            dialogArrow = $('<div class="tooltip-caret"/>').appendTo(dialog);
            dialogContent = $('<div class="tooltip-content"/>').appendTo(dialog);
        }

        function closeTooltip() {
            dialog.removeClass('fade').removeClass('in');
        }

        function onShow() {
            var text = element.attr('title') || element.attr('label') || element.data('label'),
                offset, left, top;

            if (!text) {
                closeTooltip();
            } else {
                offset = element.offset();
                dialogContent.html(text);
                left = Math.floor(offset.left + element.outerWidth() / 2 - dialog.outerWidth() / 2);
                top = Math.floor(offset.top - dialog.outerHeight());

                dialog.css({
                    left: left,
                    top: top
                }).addClass('fade').addClass('in');
            }
        }

        function onHide() {
            dialogContent.html('...');
            dialog
                .removeClass('fade')
                .removeClass('in')
                .css({left: -1000, top: -1000});
        }

        function resetTimeout() {
            if (mouseOverTimeoutId) {
                try {
                    window.clearTimeout(mouseOverTimeoutId);
                } catch (e) {
                }
            }

            if (mouseLeaveTimeoutId) {
                try {
                    window.clearTimeout(mouseLeaveTimeoutId);
                } catch (e) {
                }
            }
        }

        function onOver(target) {
            if (debug) {
                console.log('onOver');
            }
            resetTimeout();
            // check title exists.
            element = target;

            mouseLeaveTimeoutId = 0;
            mouseOverTimeoutId = window.setTimeout(onShow, mouseOverTimeout);

        }

        function onLeave() {
            if (debug) {
                console.log('onLeave');
            }
            resetTimeout();
            mouseOverTimeoutId = 0;
            mouseLeaveTimeoutId = window.setTimeout(onHide, mouseLeaveTimeout);
        }

        $(document).on('mouseover', '[data-hover="tooltip"]', function (evt) {
            onOver($(evt.currentTarget));
        }).on('mouseleave', '[data-hover="tooltip"]', function () {
            onLeave();
        }).on('pagechanged', function () {
            closeTooltip();
        });

        createTooltip();
    };

    $(document).ready(function () {
        new MyTooltip();
    });
});