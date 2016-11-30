define(['jquery', 'underscore', 'platform/core/core'], function ($, _, $kd) {
    var _debug = true;

    /**
     * Accept crop avatar
     */
    $kd.action('field-avatar-crop', function (btn) {
            var form = btn.closest('form'),
                data = form.serializeJSON().cropit,
                _submitPreview = $('.field-preview-img'),
                _submitInput = $('.hidden.avatar-value'),
                _isDialog = form.closest('.hyves-dialog').length > 0,
                _opt = data.options.split(','),
                _previewScale = _submitPreview.parent().width() * 1.0 / parseInt(_opt[2]);


            if (_debug)
                console.log(_isDialog, data);


            // close modal if needed
            _submitInput.val(JSON.stringify(data));


            _submitPreview.attr({
                width: Math.floor(_opt[0] * _previewScale),
                height: Math.floor(_opt[1] * _previewScale),
                src: data.url
            }).css({
                left: Math.floor(_opt[4] * _previewScale * -1),
                top: Math.floor(_opt[5] * _previewScale * -1),
                position: 'absolute'
            });

            if (_isDialog)
                $kd.closeModal();

        })
        .action('field-avatar-upload', function (btn) {
            var input = $(btn.data('target')),
                url = $kd.getUrl('ajax/platform/photo/upload/temp', {}),
                _modalUrl = 'ajax/platform/photo/field-avatar/dialog',
                _container = '.cropit-container';

            requirejs(['kendo/extensions/jquery.cropit'], function () {
            });

            if (!input.data('upload')) {
                input.data('upload', new PhotosUpload(input, {
                    url: url,
                    fileName: 'fileUpload',
                    onQueue: function (plugin) {
                        $kd.modal(_modalUrl, {})
                            .done(function () {
                                window.setTimeout(function () {
                                    plugin.processQueue();
                                }, 200)
                            });
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
                    onUploadSuccess: function (eid, id, data) {
                        $(_container).data('src', data.url);
                        $('.cropit_temp_id', _container).val(data.id);
                        $('.cropit_url', _container).val(data.url);
                        new CropIt(_container)
                    }
                }));
            }
            input.trigger('click');
        })
        .action('tl-avatar-upload', function (btn) {
            var input = $(btn.data('target')),
                url = $kd.getUrl('ajax/platform/photo/upload/temp', {}),
                _modalData= {obj: btn.data('obj')},
                _modalUrl = 'ajax/platform/photo/avatar/edit-avatar-dialog',
                _container = '.cropit-container';

            console.log(_modalData);

            requirejs(['kendo/extensions/jquery.cropit'], function () {});

            if (!input.data('upload')) {
                input.data('upload', new PhotosUpload(input, {
                    url: url,
                    fileName: 'fileUpload',
                    onQueue: function (plugin) {
                        $kd.modal(_modalUrl, _modalData)
                            .done(function () {
                                window.setTimeout(function () {
                                    plugin.processQueue();
                                }, 200)
                            });
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
                    onUploadSuccess: function (eid, id, data) {
                        $(_container).data('src', data.url);
                        $('.cropit_temp_id', _container).val(data.id);
                        $('.cropit_url', _container).val(data.url);
                        new CropIt(_container)
                    }
                }));
            }
            input.trigger('click');
        });
});