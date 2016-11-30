define(['jquery', 'underscore', 'platform/core/core'], function ($, _, $kd) {
    var debug = true;

    var defaultOptions = {
        minChars: 1,
        delay: 150,
        cache: 1,
        menuClass: '',
        limit: 5,
        useCache: false,
        duplicate: function () {
            return false;
        },
        outer: function (input) {
            return input.closest('div');
        },
        align: function (input) {
            return input.closest('div');
        },
        renderItem: function (sc, item, search) {
            return $('<div class="autocomplete-suggestion"></div>')
                .data('val', item.name).data('item', item).data('search', search).html('<img src="' + item.img + '" />' + '<span>' + item.name + '</span>')
                .appendTo(sc);
        },
        onSelect: function (e, val, item, input) {
            input.trigger('pushitem', item)
        },
        source: function (val, context, suggest) {
            $kd.ajax('ajax/platform/core/suggest/list', {q: val, context: context})
                .done(function (res) {
                    suggest(res);
                });
        }
    };

    var SelectInput = function (element, options) {
        options = $.extend({}, defaultOptions, options);

        var that = $(element);

        var outer = options.outer(that);
        var align = options.align(that);
        var multiple = that.data('multiple');
        var tokenName = that.data('name');


        that.cache = {};
        that.lastVal = '';
        that.tags = [];


        if (debug) {
            console.log('multiple', multiple);
        }

        that.attr('autocomplete', 'off');
        that.sc = $('<div>', {
            class: 'autocomplete-suggestions'
        }).appendTo('body');

        that.closest('form')
            .on('clean', function () {
                outer.addClass('hidden');
                outer.find('.token').remove();
            });

        that.cleanup = function () {
            outer.find('.select-token').remove();
            outer.find('.cleanup').remove();
            that.prop('disabled', false).removeClass('bg-disabled');
            that.val('');
            return that;
        }

        that.on('cleanup', function () {
            that.cleanup();
        });

        outer.on('click', '.cleanup', function (e) {
            that.cleanup().focus();
        });


        that.updateSC = function () {
            that.sc.css({
                top: align.offset().top + align.outerHeight(),
                left: align.offset().left - 2,
                width: align.outerWidth() + 2
            });
        };

        function suggest(data) {
            var val = that.val();
            that.cache[val] = data;
            if (data.length && val.length >= options.minChars) {
                var stage = $('<div class="autocomplete-stages"></div>');
                for (var i = 0; i < data.length && i < options.limit; i++) {
                    options.renderItem(stage, data[i], val);
                }

                that.sc.html(stage).show();
                that.updateSC(0);
            }
            else {
                that.sc.hide();
            }

            if (debug) {
                console.info("update suggestions");
            }
        }


        that.on('pushitem', function (e, item) {
            /**
             * check if item is duplicateds
             */
            if (multiple) {
                var token = $('<span class="select-token"></span>').text(item.name + ' ');
                $('<input type="hidden" />').prop('name', tokenName + '[]').val(item.id + '@' + item.type).appendTo(token);
                $('<a class="cleanup ion-backspace" data-toggle="btn-remove-token"></a>').appendTo(token);
                token.insertBefore(that);
                that.val('');

            } else {

                that.prop('disabled', true).addClass('bg-disabled');
                $('<a class="absolute cleanup ion-backspace" data-toggle="btn-remove-token"></a>').insertAfter(that);
                var token = $('<span class="select-token hidden"></span>');
                $('<input type="hidden" />').prop('name', tokenName).val(item.id + '@' + item.type).appendTo(token);
                token.appendTo(outer);

                that.val(item.name);
                // render from out where
            }

        });

        that.sc.on('mouseleave', '.autocomplete-suggestion', function () {
            $('.autocomplete-suggestion.selected', that.sc).removeClass('selected');
        });

        that.sc.on('mouseenter', '.autocomplete-suggestion', function () {
            $('.autocomplete-suggestion.selected', that.sc).removeClass('selected');
            $(this).addClass('selected');
        });

        that.sc.on('mousedown', '.autocomplete-suggestion', function (e) {

            var sel = $(e.currentTarget), val = sel.data('val'), item = sel.data('item');
            if (val || sel.hasClass('autocomplete-suggestion')) { // else outside click
                options.onSelect(e, val, item, that);
                that.focus();
                that.sc.hide();
            }
        });

        that.on('blur.autocomplete', function () {
            var over_sb;
            try {
                over_sb = $('.autocomplete-suggestions:hover', that.sc).length;
            } catch (e) {
                over_sb = 0;
            } // IE7 fix :hover
            if (!over_sb) {
                that.lastVal = that.val();
                that.sc.hide();
            } else {
                that.focus();
            }
        });

        if (!options.minChars) {
            that.on('focus.autocomplete', function () {
                that.lastVal = '\n';
                that.trigger('keyup.autocomplete');
            });
        }

        that.on('keydown.autocomplete', function (e) {
            // down (40), up (38)
            if ((e.which == 40 || e.which == 38) && that.sc.html()) {
                var next, sel = $('.autocomplete-suggestion.selected', that.sc);
                if (!sel.length) {
                    next = (e.which == 40) ? $('.autocomplete-suggestion', that.sc).first() : $('.autocomplete-suggestion', that.sc).last();
                    that.val(next.addClass('selected').data('val'));
                } else {
                    next = (e.which == 40) ? sel.next('.autocomplete-suggestion') : sel.prev('.autocomplete-suggestion');
                    if (next.length) {
                        sel.removeClass('selected');
                        that.val(next.addClass('selected').data('val'));
                    }
                    else {
                        sel.removeClass('selected');
                        that.val(that.lastVal);
                        next = 0;
                    }
                }
                that.updateSC(0, next);
                return false;
            }
            else
                if (e.which == 27) {
                    /**
                     * escape key code
                     */
                    that.val(that.lastVal).sc.hide();
                }
                else
                    if (e.which == 13) {
                        /**
                         * enter key code
                         */
                        var sel = $('.autocomplete-suggestion.selected', that.sc);
                        if (sel.length) {
                            options.onSelect(e, sel.data('val'), sel.data('item'), that);
                            setTimeout(function () {
                                that.focus().sc.hide();
                            }, 10);
                        }
                    }
        });

        that.on('keyup.autocomplete', function (e) {
            if (!~$.inArray(e.which, [27, 38, 40, 37, 39])) {
                var val = that.val();
                if (val.length >= options.minChars) {
                    if (val != that.lastVal) {
                        that.lastVal = val;
                        clearTimeout(that.timer);
                        if (options.cache) {
                            if (val in that.cache) {
                                suggest(that.cache[val]);
                                return;
                            }
                            // no requests if previous suggestions were empty
                            for (var i = 1; i < val.length - options.minChars; i++) {
                                var part = val.slice(0, val.length - i);
                                if (part in that.cache && !that.cache[part].length) {
                                    suggest([]);
                                    return;
                                }
                            }
                        }
                        that.timer = setTimeout(function () {
                            options.source(val, that.data('context'), suggest)
                        }, options.delay);
                    }
                } else {
                    that.lastVal = val;
                    that.sc.hide();
                }
            }
        });

        $(window).on('resize.autocomplete', that.updateSC);

        if (debug) {
            console.info('init selection input');
        }
    };

    window.SelectInput = SelectInput;


    $(document).on('focus', '[data-toggle="select"]', function (evt) {
        var $e = $(evt.currentTarget);
        if (!$e.data('select')) {
            $e.data('select', new SelectInput($e));
        }
    })
});