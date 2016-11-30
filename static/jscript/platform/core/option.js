/**
 * Control options menu
 */
define(['jquery', 'underscore', 'platform/core/core'], function ($, _, $kd) {
    var _debug = false,
        _toggleOptions = '[data-toggle="options"]',
        _Dialog,
        _waitingTime = 250,
        _dialogTpl = '<div class="options-dialog hidden"><div class="options-overlay"><div class="options-stageout"><div class="options-stagein"><div class="options-content"></div></div></div><div class="options-tailer"><div></div></div></div></div>',
        _loadingTpl = '<div class="options-content"><ul class="options-menu"><li class="options-loading">Loading...</li></ul></div>',
        _dataKey = 'options';

    _Dialog = function (ele, clientX, clientY) {
        this.element = $(ele);
        this.dialog = false;
        this.clientY = clientY;
        this.forItem = this.element.data('for') || 'for-icon';
        this.forBeeber = /beeber/i.test(this.element.data('for')) ? true : false;
        this.parent = this.element.parent();
        this.inline = false;
    };

    /**
     *
     */
    _Dialog.prototype.hideDialog = function () {
        if (!this.dialog || !this.dialog.length) return;
        this.dialog.addClass('hidden');
    }

    /**
     *
     */
    _Dialog.prototype.showDialog = function () {
        this.dialog.removeClass('hidden');
    }

    /**
     *
     */
    _Dialog.prototype.closeDialog = function () {
        this.dialog.addClass('hidden');
    }

    _Dialog.prototype.updateDialogPositionForFlying = function () {
        _debug && console.log("_OptionsDialog updateDialogPosition");

        if (!this.element) return;


        var tailerX =  0, // use 12 incase use tailer
            offset = this.element.offset(),
            tailPos = {},
            isLeft = /left/i.test(this.element.data('for')) ? true : false,
            alignX = isLeft ? 'left' : 'right',
            alignY = 'down',
            left = offset.left + Math.ceil(this.element.outerWidth() / 2),
            top = offset.top + this.element.outerHeight();

        if (isLeft) {
            left = offset.left - 12;
            tailPos.left = Math.ceil(this.element.outerWidth() / 2 - 10 + tailerX);
        } else {
            left = offset.left + this.element.outerWidth() + tailerX;
            tailPos.right = Math.ceil(this.element.outerWidth() / 2 - 10 + tailerX);
        }

        if (_debug) {
            console.log('offset', offset);
            console.log('element width', this.element.width());
            console.log('element height', this.element.height())
        }

        if (this.forBeeber && window.innerWidth < 380) {
            if (isLeft) {
                left = 0;
                this.dialog.find('.options-overlay').css({left: 0});
            } else {
                left = window.innerWidth;
                this.dialog.find('.options-overlay').css({right: 0});

            }

        }

        if (this.clientY > 280) {
            top = offset.top;
            alignY = 'up';
        }

        this.dialog.addClass(alignX).addClass(alignY).css({left: left, top: top});
        this.dialog.find('.options-tailer').css(tailPos);
    }

    /**
     * Update dialog position
     */
    _Dialog.prototype.updateDialogPositionForInline = function () {

        _debug && console.log("_OptionsDialog updateDialogPosition");

        if (!this.element) return;

        var offset = this.element.offset(),
            dlgPos = {},
            tailPos = {},
            isLeft = /left/i.test(this.element.data('for')) ? true : false,
            alignX = isLeft ? 'left' : 'right',
            alignY = 'down';

        if (isLeft) {
            dlgPos.left = -1*tailerX;
            tailPos.left = Math.ceil(this.element.outerWidth() / 2 - 10 + tailerX);
        } else {
            dlgPos.right = -1*tailerX;
            tailPos.right = Math.ceil(this.element.outerWidth() / 2 - 10 + tailerX);
        }

        if (_debug) {
            console.log('offset', offset);
            console.log('element width', this.element.width());
            console.log('element height', this.element.height())
        }

        if (this.clientY > 280) {
            dlgPos.bottom = this.element.outerHeight();
            alignY = 'up';
        } else {
            dlgPos.top = this.element.outerHeight();
            alignY = 'down';
        }
        this.dialog
            .addClass(alignX)
            .addClass(alignY)
            .css(dlgPos);

        this.dialog.find('.options-tailer').css(tailPos);
    }

    /**
     *
     */
    _Dialog.prototype.createDialog = function () {

        _debug && console.log("_OptionsDialog createDialog");

        if (this.inline) {
            this.dialog = $('.options-dialog:first', this.parent);
            if (this.dialog.length) return;
        }

        if (this.inline) {
            this.dialog = $(_.template(_dialogTpl)()).appendTo(this.parent);
        } else {
            this.dialog = $(_.template(_dialogTpl)()).appendTo('body');
        }


        this.dialog.addClass(this.element.data('for'));

        this.dialog.on('hide', $.proxy(this.hideDialog, this));

        this.loadContent();

    }

    /**
     * Load content
     */
    _Dialog.prototype.loadContent = function () {

        if (!this.dialog) return;
        var that = this,
            url = this.element.data('url'),
            eid = '#' + this.element.eid(),
            obj = $.extend({eid: eid}, this.element.data('object'));

        function loadSuccess(response) {
            that.dialog.find('.options-stagein')
                .html(response.html);
            that.dialog.bootInit();
        }

        $kd.ajax(url, obj)
            .done(loadSuccess);
    }

    /***
     * Open dialog from this data
     */
    _Dialog.prototype.toggleDialog = function () {

        _debug && console.log("_OptionsDialog openDialog");

        if (!this.dialog) {
            this.createDialog();
            $('.options-stagein', this.dialog).html(_.template(_loadingTpl)());
        }

        if (this.inline) {
            this.updateDialogPositionForInline();
        } else {
            this.updateDialogPositionForFlying();
        }

        /**
         * Check to show later
         */
        if (this.dialog.hasClass('hidden')) {
            var that = this;

            window.setTimeout(function () {
                that.showDialog();
            }, _waitingTime);
        }
    }

    /**
     * clear menu
     */
    function clearMenus() {
        $('.options-dialog').trigger('hide');
        _debug && console.log("clear menu drop downs");
    }

    $(document).on('click', '.pl-bear-state', function () {
        var ele = $(this);
        ele.find('>span.badge').html('').addClass('hidden');
        $kd.ajax(ele.data('bear'), {});
    }).on('click', function (evt) {
        if (!evt.isDefaultPrevented()) clearMenus();
    }).on('pagechanged', function () {
        clearMenus();
    }).on('click', _toggleOptions, function (evt) {
        var ele = $(evt.currentTarget),
            instance = ele.data(_dataKey);

        if (!instance) {
            ele.data(_dataKey, instance = new _Dialog(evt.currentTarget, evt.clientX, evt.clientY));
        }
        instance.toggleDialog();
    });
});