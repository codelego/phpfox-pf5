/**
 * Photo Upload Button
 */
define(['jquery', 'underscore', 'platform/core/core'], function ($, _, $kd) {
    var _AjaxUploadHandler,
        _debug = false,
        _dataKey = 'ajaxUploadHandler',
        _Submit,
        _previewTpl = '<div class="photo-upload-item-ow" id="<%= id %>"><div class="upload-preview-stage"><span class="preview"></span><div class="progress-bar"></div></div></div>',
        _hiddenTpl = '<input type="hidden" name="photoTemp[]" class="hidden" value="<%= value %>"/>';

    /**
     * Define submit handler
     * @param element Must be form element
     * @private
     */
    _Submit = function (element) {
        var _form = $(element),
            _url = _form.data('url'),
            _data = _form.serializeJSON();

        _debug && console.log(_data);

        $kd.ajax(_url, _data)
            .done(function (response) {
                _form.trigger('postSuccess', response);
                Hyves.destroy();

                if (/feed/i.test(response.context)) {
                    // reload activity.
                    $('.activity-stream').trigger('loadnew');
                }
            }).always(function () {
            _form.trigger('postComplete');
        }).fail(function () {
            _form.trigger('postError');
        });
    };


    _AjaxUploadHandler = function (input) {
        var _url = $kd.getUrl(input.data('url'), {}),
            _modalUrl = input.data('modal'),
            _more = input.data('more');

        input.on('clearBootInit', function () {
            input.data(_dataKey, false);
        });

        input.data('upload', new PhotosUpload(input, {
            url: _url,
            fileName: 'fileUpload',
            onQueue: function (plugin) {
                if (_more) {
                    plugin.processQueue();
                } else {
                    $kd.modal(_modalUrl, {})
                        .done(function () {
                            window.setTimeout(function () {
                                plugin.processQueue();
                            }, 200)
                        });
                }
            },
            onBeforeUpload: function (eid) {
                $(_.template(_previewTpl)({id: eid}))[_more ? 'prependTo' : 'appendTo'](input.data('preview'));
            },
            onUploadProgress: function (eid, pos, percentage, input) {
                $('.progress-bar', '#' + eid).css({width: percentage + '%'});
            },
            onUploadSuccess: function (eid, id, data, input) {
                var preview = $('#' + eid);

                $('.progress-bar', '#' + eid).remove();

                if (_debug) {
                    console.log(data);
                }

                if (data.id) {
                    preview.find('.preview').css({'background-image': 'url(' + data.url + ')'});
                    $(_.template(_hiddenTpl)({value: data.id})).appendTo(preview);
                }
            }
        }));
    }

    _AjaxUploadMoreHandler = function (input) {
        var url = $kd.getUrl(input.data('url'), {}),
            modalUrl = input.data('modal');

        input.on('clearBootInit', function () {
            input.data(_dataKey, false);
        });

        input.data('upload', new PhotosUpload(input, {
            url: url,
            fileName: 'fileUpload',
            onQueue: function (plugin) {
                $kd.modal(modalUrl, {})
                    .done(function () {
                        window.setTimeout(function () {
                            plugin.processQueue();
                        }, 1000)
                    });
            },
            onBeforeUpload: function (eid) {
                $(_.template(_previewTpl)({id: eid})).appendTo(input.data('preview'));
            },
            onUploadProgress: function (eid, pos, percentage, input) {
                if (_debug) {
                    console.log({
                        eid: eid,
                        pos: pos,
                        percentage: percentage,
                        input: input
                    });
                }

            },
            onUploadSuccess: function (eid, id, data, input) {
                var preview = $('#' + eid);

                if (_debug) {
                    console.log(data);
                }

                if (data.id) {
                    preview.find('.preview').css({'background-image': 'url(' + data.url + ')'});
                    $(_.template(_hiddenTpl)({value: data.id})).appendTo(preview);
                }
            }
        }));
    }

    $.fn.ajaxUploadHandler = function () {
        this.each(function () {
            var e = $(this);
            return e.data(_dataKey) || e.data(_dataKey, new _AjaxUploadHandler(e));
        });
    }

    /**
     * handle button upload photo
     */
    $kd.action('btn-album-upload', function (btn) {
        $(btn.data('target')).trigger('click');
    }).action('btn-album-switch-mode', function (btn) {
        var form = $('.photo-album-switch-form'),
            hidden = $('[name="new_album"]', form);
        if (form.hasClass('mode1')) {
            btn.data('mode', "0").find('.text').text(btn.data('label0'));
            form.removeClass('mode0').addClass('mode1');
            hidden.val("0");
        } else {
            btn.data('mode', "1").find('.text').text(btn.data('label1'));
            form.removeClass('mode0').addClass('mode1');
            hidden.val("1");
        }
    });
});
