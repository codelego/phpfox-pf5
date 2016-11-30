define(['jquery'], function ($) {
    var _key = 'scrollToTop',
        _debug = false,
        _ScrollToTop = function (ele) {
            var element = ele,
                distance = 300,
                speed = 200
                ;

            _debug && console.log('_ScrollToTop.construct');

            element.on('click', function () {
                $('html, body').animate({scrollTop: 0}, speed);
            });

            $(window).on('scroll', function () {
                if ($(this).scrollTop() > distance) {
                    element.addClass('in')
                } else {
                    element.removeClass('in');
                }
            });
        };

    $.fn.scrollToTop = function () {
        var ele = $(this),
            instance;

        instance = ele.data(_key);

        if (!instance) {
            ele.data(_key, instance = new _ScrollToTop(ele));
        }
        return instance;
    };
});