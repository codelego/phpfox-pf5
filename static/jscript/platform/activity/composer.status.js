define(['jquery', 'platform/core/core'], function ($, $kd) {
    var _debug = false,
        _dataKey = 'feedComposer',
        statusBox = 'textarea.mentions-input',
        postUrl = 'ajax/platform/activity/activity/post',
        FeedComposer;

    FeedComposer = function (element) {
        var _form = $(element),
            _target = _form.data('target');


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
                _form.trigger('clean');
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
            var sendData = $.extend({}, _form.serializeJSON(), {fromComposer: 1});

            $(statusBox, _form).mentionsInput('val', function (text) {
                sendData.statusTxt = text;
            });

            if (_.isEmpty(sendData.statusTxt)) {
                alert("Add your status");
                return;
            }


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
    $.fn.feedComposer = function () {
        return this.each(function () {
            return $.data(this, _dataKey) || $.data(this, _dataKey, new FeedComposer(this, $.data(this, 'composer')));
        });
    }
});