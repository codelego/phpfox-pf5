define(['jquery', 'underscore', 'platform/core/core'], function ($, _, $kd) {

    var LinkComposer,
        _dataKey = 'linkComposer';

    LinkComposer = function (ele) {
        var _form = $(ele),
            loading = false,
            attatched = false,
            triedLinks = []
            ;
        _form.on('onLinkAttatch', function (evt, data) {
            if (loading) return;
            if (attatched) return;

            var checkLink = false;
            /**
             * check links
             */
            for (var index in data.links) {
                var temp = data.links[index].trim();
                if (false == _.contains(triedLinks, temp)) {
                    checkLink = temp;
                    break;
                }
            }
            if (checkLink) {
                parse(checkLink);
            }
        });

        _form.on('onRemoveAttachment', function () {
            clean();
        }).on('clean', function () {
            clean();
        }).on('clearBootInit', function () {
            _form.data(_dataKey, false);
        });

        function clean() {
            loading = false;
            attatched = false;
            triedLinks = [];

            $('.composer-preview-link', _form).remove();
        }

        /**
         * call success
         * @param data
         */
        function success(data) {
            if (attatched) return;

            if (data.code == 200) {
                attatched = true;
                _form.find('.fc-att-ow').append(data.html);
            } else {
                // do nothing
            }
        }

        /**
         * parse link failed
         */
        function error() {
            console.log('Could not parse url ');
        }

        /**
         * complete
         */
        function complete() {
            loading = false;
            _form.trigger('onLoading:done');
        }

        function parse(link) {
            if (loading) return;

            loading = true;
            link = link.trim();

            triedLinks.push(link);

            _form.trigger('onLoading:start');

            $kd.ajax('ajax/platform/core/link/composer-preview', {url: link})
                .done(success)
                .error()
                .complete(complete);
        }
    };

    $kd.action('fc-attatch-remove', function (ele) {
        ele.closest('form').trigger('onRemoveAttachment');
    }).action('fc-attatch-as-link', function (ele) {
        var outer = ele.closest('.composer-preview-link');

        if (outer.hasClass('as-video')) {
            outer.removeClass('as-video').addClass('as-link');
            $('.attachment-type', outer).val('link');
            ele.text(ele.data('label2'));
        } else {
            outer.removeClass('as-link').addClass('as-video');
            ele.text(ele.data('label1'));
            $('.attachment-type', outer).val('video');
        }
    });

    $.fn.linkComposer = function () {
        this.data(_dataKey) || this.data(_dataKey, new LinkComposer(this));
    };
});