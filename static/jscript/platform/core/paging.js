/**
 * Data Paging
 */
define(['jquery', 'platform/core/core'], function ($, $kd) {
    var Paging,
        _debug = false,// active debug when be required
        _dataKey = 'paging';

    /**
     * Paging data
     * @constructor
     */
    Paging = function (ele) {
        var _element = $(ele),
            _stage = _element.find('.paging-stage'),
            _content = _element.find('.paging-content'),
            _isWindow = (_element.css('overflow-y') === 'visible'),
            _scroll = _isWindow ? $(window) : _element,
            _continue = (_element.data('continue') ? 1 : 0),
            _offset = 0,
            _delta = 30,
            _tagKey = _element.eid(),
            _endless = _element.data('endless'),
            _loading = false;


        /**
         * Return mid feedId in the collection
         * @returns {*}
         */
        function getMaxId() {
            var item = $('.card-wrap:first', _element);

            if (item.length) {
                return item.data('id');
            }
            return 0;
        }

        /**
         * Return min feedId in the collection
         * @returns {*}
         */
        function getMinId() {
            var item = $('.card-wrap:last', _element);

            if (item.length) {
                return item.data('id');
            }
            return 0;
        }

        function loadMoreStart() {
            _loading = true;
            _element.find('.pager.more>a').toggleClass('hidden');
        }

        function loadMoreComplete() {
            _loading = false;
            _element.find('.pager.more>a').toggleClass('hidden');
        }

        /**
         * Response data should contain html
         * @param response
         */
        function loadMoreDone(response) {
            if (response.html)
                _content.append(response.html);

            if (!response.hasNext)
                $('.pager.more,.pager-more', _element).addClass('hidden');
        }

        function loadMoreFail() {

        }

        /**
         *
         */
        function loadMore() {

            if (_loading) {
                return
            }

            loadMoreStart();

            var pager = _element.data('pager'),
                query = _element.data('query'),
                config = _element.data('config'),
                url = _element.data('url'),
                sendData = $.extend({}, {query: query, config: config,pagingUrl: url});

            if (_continue) {
                $.extend(sendData, {
                    mode: 'more',
                    minId: getMinId(),
                    maxId: getMaxId()
                });
            } else {
                if (pager.page >= pager.totalPage) return;
                pager.page = pager.page + 1;
                _element.data('pager', pager);
                $.extend(sendData, pager);
            }


            $kd.ajax(url, sendData)
                .always(loadMoreComplete)
                .success(loadMoreDone)
                .error(loadMoreFail);
        }

        function loadNewStart() {
            _loading = true;
        }

        function loadNewComplete() {
            _loading = false;
        }

        /**
         * Response data should contain html
         * @param response
         */
        function loadNewDone(response) {
            if (response.html) {
                _content.prepend(response.html);
            }
        }

        function loadNewFail() {

        }

        /**
         *
         */
        function loadNew() {

            if (_loading) {
                return
            }

            loadNewStart();

            var pager = _element.data('pager'),
                query = _element.data('query'),
                config = _element.data('config'),
                url = _element.data('url'),
                sendData = $.extend({}, {query: query, config: config,pagingUrl: url});

            if (_continue) {
                $.extend(sendData, {
                    mode: 'new',
                    minId: getMinId(),
                    maxId: getMaxId()
                });
            } else {
                if (pager.page < 1) return;
                pager.page = pager.page - 1;
                _element.data('pager', pager);
                $.extend(sendData, pager);
            }


            $kd.ajax(url, sendData)
                .always(loadNewComplete)
                .success(loadNewDone)
                .error(loadNewFail);
        }

        function loadNextStart() {
            _loading = true;

            var pager = _element.data('pager');
            if (pager.page > 1) {
                $('.pager-prev', _element).removeClass('disabled');
            }

            if (pager.page >= pager.totalPage) {
                $('.pager-next', _element).addClass('disabled');
            }
        }

        function loadNextComplete() {
            _loading = false;
        }

        function loadNextFail() {
            if (_debug) {
                console.log('load next fail');
            }
        }

        function loadNextDone(response) {
            if (response.html) {
                _content.html(response.html);
            }
        }

        function loadNext() {

            if (_loading) return;

            if (_debug) {
                console.log('load page');
            }

            var pager = _element.data('pager'),
                query = _element.data('query'),
                config = _element.data('config'),
                url = _element.data('url');

            if (pager.page >= pager.totalPage) return;

            pager.page = pager.page + 1;

            _element.data('pager', pager);

            console.log(pager);

            loadNextStart();


            $kd.ajax(url, $.extend({}, pager, {query: query, config: config}))
                .always(loadNextComplete)
                .success(loadNextDone)
                .error(loadNextFail);
        }


        function loadPrevStart() {
            _loading = true;

            var pager = _element.data('pager');
            if (pager.page < 2) {
                $('.pager-prev', _element).addClass('disabled');
            }

            if (pager.page < pager.totalPage) {
                $('.pager-next', _element).removeClass('disabled');
            }
        }

        function loadPrevComplete() {
            _loading = false;
        }

        function loadPrevDone(response) {
            if (response.html) {
                _content.html(response.html);
            }
        }

        function loadPrevFail() {

        }

        function _setBindingEndless() {
            _scroll.off('scroll.endless')
                .on('scroll.endless', function () {
                    _offset = Math.ceil((_isWindow ? _scroll.scrollTop() : _element.offset().top)
                        - _stage.offset().top + (_isWindow ? window.innerHeight : _scroll.height()) - _stage.outerHeight() + _delta);

                    _debug && console.log(_tagKey, _offset, _isWindow);

                    if (_offset > 0)
                        loadMore();
                });
        }

        function loadPrev() {

            if (_loading) return;

            if (_debug) {
                console.log(_tagKey, 'load page');
            }

            var pager = _element.data('pager'),
                query = _element.data('query'),
                url = _element.data('url');

            if (pager.page < 2) return;

            pager.page = pager.page - 1;

            _element.data('pager', pager);

            console.log(pager);

            loadPrevStart();

            $kd.ajax(url, $.extend({}, pager, {query: query}))
                .always(loadPrevComplete)
                .success(loadPrevDone)
                .error(loadPrevFail);
        }


        if (_endless)
            _setBindingEndless();

        $(document).on('page_change_start', function () {
            _scroll.off('scroll.endless');
        });


        _element.on('loadnew', function () {
            loadNew();
        }).on('loadmore', function () {
            loadMore();
        }).on('loadnext', function () {
            loadNext();
        }).on('loadprev', function () {
            loadPrev();
        }).on('clearBootInit', function () {
            ele.data(_dataKey, false);
        });
    };

    $.fn.paging = function () {
        var ele = $(this.get(0));
        if (!$.data(ele, _dataKey)) {
            ele.data(_dataKey, new Paging(ele))
        }
        return $.data(ele, _dataKey);
    }

    $kd.action('pager',function(_ele, evt){
        var _paging = _ele.closest('.paging');

        if (_paging.length) {
            _paging.trigger('load' + _ele.data('pager'), _ele.data('page') || {});
        }
        evt.preventDefault();
    });
});