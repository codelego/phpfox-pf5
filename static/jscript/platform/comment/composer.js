define(['jquery', 'platform/core/core'], function ($, $kd) {
    var _debug = true,
        _dataKey = 'commentComposer',
        statusBox = 'textarea.mentions-input',
        postUrl = 'ajax/platform/comment/comment/add',
        CommentComposer,
        defaults = {};

    CommentComposer = function (element, settings) {
        var _form = $(element),
            _target = _form.data('target'),
            _settings = $.extend({}, defaults, settings);


        function onSuccess(response) {

            if (_debug) {
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
        }).on('clearBootInit', function () {
            _form.data(_dataKey, false);
        });

        if (_form.data('link') && typeof _form['linkComposer'] == 'function') {
            _form.linkComposer();
        }
    }


    /**
     * Constructor of activity stream
     * @returns {*}
     */
    $.fn.commentComposer = function () {
        return this.each(function () {
            return $.data(this, _dataKey) || $.data(this, _dataKey, new CommentComposer(this, $.data(this, 'composer')));
        });
    }

    /**
     * Focus status box action
     */
    $(document).on('focus', '[data-toggle="comment-box"]', function (evt) {
        $(evt.currentTarget).closest('form').commentComposer({});
    });
});