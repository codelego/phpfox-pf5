define(['jquery', 'underscore', 'platform/core/core'], function ($, _, $kd) {
    var ModalDialog,
        _debug = true,
        _dialogTpl = '<div id="modal-dialog" class="modal-dialog">' +
            '<div class="modal-overlay" />' +
            '<div class="modal-stageout">' +
            '<div class="modal-stagein">' +
            '</div>' +
            '</div>' +
            '</div>';

    /**
     * Modal Constructor
     * @private
     */
    ModalDialog = function () {
        this.element = null;
    };

    /**
     * Make default behavior from Modal modal
     * @return {ModalDialog}
     */
    ModalDialog.prototype.make = function () {
        this.element = $(_.template(_dialogTpl)()).appendTo('body');
        this.element.find('.modal-overlay').on('click', $.proxy(this.destroy, this));
        return this;
    };

    /**
     * Create Modal modal
     * @param content
     * @returns {ModalDialog}
     */
    ModalDialog.prototype.create = function (content) {
        _debug && console.log("Destroy Modal Dialog");

        this.make();

        this.element.find('.modal-stagein:first').html(content);

        $(document)
            .on('closemodal', $.proxy(this.destroy, this))
            .on('page_change_start', $.proxy(this.destroy, this))
            .on('click', '[data-toggle="btn-modal-close"]', $.proxy(this.destroy, this));

        return this;
    };

    /**
     * Show Modal modal
     * @returns {ModalDialog}
     */
    ModalDialog.prototype.show = function () {

        _debug && console.log("Show Modal Dialog");

        this.element.find('.modal-body.fixheight').css({
            maxHeight: Math.ceil($(window).height() - 200)
        });

        this.element.find('.paging')
            .not('paging-full')
            .css({
                maxHeight: Math.ceil($(window).height() - 200)
            });

        /**
         * fix boot init for loaded content.
         */
        this.element.bootInit();

        $('body').addClass('modal-open');

        return this;
    };

    /**
     * Hide modal modal dialog
     *
     * @returns {ModalDialog}
     */
    ModalDialog.prototype.hide = function () {

        _debug && console.log("Hide Modal Dialog");

        $('body').removeClass('modal-open');

        return this;
    };

    /**
     * Destroy Modal modal dialog
     * @returns {ModalDialog}
     */
    ModalDialog.prototype.destroy = function () {

        if (!this.element) return this;

        _debug && console.log("Destroy Modal Dialog");

        $('body').removeClass('modal-open');

        this.element.remove();

        this.element = false;

        return this;
    };

    $kd.cmd('modal', function (ele) {
        $kd.modal(ele.data('url'));
    });
    window.Modal = new ModalDialog();
});