
/**
 * Activity Share Javascript Component
 *
 * @author Nam Nguyen
 * @project Picaso
 * @version 1.0.1
 */
define(['jquery', 'platform/core/core'], function ($, $kd) {

    var debug = true,
        propKey = 'shareComposer',
        statusBox = 'textarea.mentions-input',
        postUrl = 'ajax/platform/share/share/add',
        ShareComposer,
        defaults = {};

    ShareComposer = function (element, settings) {
        var _form = $(element),
            _target = _form.data('target'),
            _settings = $.extend({}, defaults, settings);


        function onSuccess(response) {

            if (debug) {
                console.log('clean data of status form');
                console.log('activity result', response);
                // fire event to collapse new state
            }

            if ($(_target).length) {
                $(_target).trigger('loadnew');
            }

            if (typeof _form != 'undefined') {

                $(response.html).insertBefore(_form.closest('.fs-cmf-ow'));

                _form.trigger('clean');
                _form.find('textarea').val('');
                // reset mention miput
                $('textarea.mentions-input', _form).mentionsInput('reset');
            }
        }

        function onComplete() {
            onLoadingComplete();
        }

        function onError() {
            alert("Sorry, your request could not be completed");
        }


        function doFormSubmit() {
            var sendData = $.extend({}, _form.serializeJSON(), {fromComment: 1});

            $(statusBox, _form).mentionsInput('val', function (text) {
                sendData.commentTxt = text;
            });

            onLoadingStart();

            $kd.ajax(postUrl, sendData)
                .always(onComplete)
                .done(onSuccess)
                .fail(onError);
        }

        function onLoadingStart() {
            $('.fc-header-ow .ajax-indicator', _form).addClass('loading');
        }

        function onLoadingComplete() {
            $('.fc-header-ow .ajax-indicator', _form).removeClass('loading');
        }

        $(statusBox, _form).mentionsInput({});

        _form.on('onLoading:start', function () {
            onLoadingStart();
        }).on('onLoading:done', function () {
            onLoadingComplete();
        }).on('clean', function () {
            $('.fc-att-row', _form).addClass('hidden');
        }).on('submit', function (evt) {
            evt.preventDefault();
            doFormSubmit();
        });

        if (_form.data('link')) {
            _form.linkComposer();
        }
    }


    /**
     * Constructor of activity stream
     * @returns {*}
     */
    $.fn.shareComposer = function () {
        return this.each(function () {
            return $.data(this, propKey) || $.data(this, propKey, new ShareComposer(this, $.data(this, 'composer')));
        });
    }

    /**
     * Focus status box action
     */
    $(document).on('focus', '[data-toggle="share-box"]', function (evt) {
        $(evt.currentTarget).closest('form').shareComposer({});
    });

    var prop = 'mentionsInput';

    $(document).on('focus', '[data-toggle="share-box"]', function (evt) {
        var ele = $(evt.currentTarget);
        if (!ele.data(prop)) {
            ele.mentionsInput({}).focus();
            //ele.closest('form').linkComposer();
        }
    });

    $kd.action('btn-share', function (ele) {
        var data = {obj: ele.data('obj')};

        $kd.modal('ajax/platform/share/share/modal', data);

    }).action('btn-share-sumbit', function (ele) {
        var form = ele.closest('form'),
            data = form.serializeJSON();

        $('textarea.mentions-input', form).mentionsInput('val', function (text) {
            data.contentTxt = text;
        });

        $kd.ajax('ajax/platform/share/share/add', data)
            .done(function () {
                $kd.closeModal();
            });
    }).action('btn-share-own', function (ele) {
        var $f = ele.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text(ele.data('label'));
        $f.find('.share-control-ow').addClass('hidden');
    }).action('btn-share-friend', function (ele) {
        var $f = ele.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text(ele.data('label'));
        $f.find('.share-control-ow').removeClass('hidden');
        $f.find('.share-control-input').trigger('cleanup').focus();
    }).action('btn-share-group', function (ele) {
        var $f = ele.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text(ele.data('label'));
        $f.find('.share-control-ow').removeClass('hidden');
        $f.find('.share-control-input').trigger('cleanup').focus();
    }).action('btn-share-page', function (ele) {
        var $f = ele.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text(ele.data('label'));
        $f.find('.share-control-ow').removeClass('hidden');
        $f.find('.share-control-input').trigger('cleanup').focus();
    }).action('btn-share-message', function (ele) {
        var $f = ele.closest('form');
        $f.find('button[name="shareType"]').find('span.btn-text').text(ele.data('label'));
        $f.find('.share-control-ow').removeClass('hidden');
        $f.find('.share-control-input').trigger('cleanup').focus();
    });

});