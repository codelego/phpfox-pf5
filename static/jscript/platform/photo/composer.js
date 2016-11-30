define(['jquery', 'platform/core/core', 'underscore'], function ($, $kd, _) {
    var PhotoComposer,
        _debug = true,
        _dataKey = 'photoComposer',
        _previewTpl = '<div class="fc-att-photo-item-ow" id="<%= id %>"><div class="upload-preview-stage"><span class="preview"></span><div class="progress-bar"></div></div></div>',
        _hiddenTpl = '<input type="hidden" name="photoTemp[]" class="hidden" value="<%= value %>"/>';

    PhotoComposer = function (input) {
        var url = $kd.getUrl(input.data('url'), {}),
            outer = input
                .closest('form')
                .find(input.data('preview'));

        input.closest('form').on('clean', function () {
            outer.find('.fc-att-photo-item-ow').remove();
        });

        input.on('clearBootInit', function () {
            input.data(_dataKey, false);
        });

        input.data('upload', new PhotosUpload(input, {
            url: url,
            fileName: 'fileUpload',
            onQueue: function (plugin) {
                plugin.processQueue();
            },
            onBeforeUpload: function (eid) {
                $(_.template(_previewTpl)({id: eid})).appendTo(outer);
            },
            onUploadProgress: function (eid, pos, percentage) {
                $('.progress-bar', '#' + eid).css({width: percentage + '%'});
            },
            onUploadSuccess: function (eid, id, data, input) {
                var preview = $('#' + eid, outer);
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

    $.fn.photoComposer = function () {
        this.each(function () {
            var e = $(this);
            return e.data(_dataKey) || e.data(_dataKey, new PhotoComposer(e));
        });
    }
});