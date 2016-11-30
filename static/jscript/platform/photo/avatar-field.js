define(['jquery', 'platform/core/core'], function ($k, $kd) {
    var AvatarField;

    AvatarField = {
        init: function () {
            var previewImg = $('.field-preview-img');
            var cropImg = $('.field-crop-img');
            var hiddenValue = $('input.avatar-value');
            var value = hiddenValue.val();

            if (!value) return;

            var arr = value.split(';');

            var coords = {
                x: arr[2],
                y: arr[3],
                w: arr[6],
                h: arr[7]
            };

            var rx = 100 / coords.w;
            var ry = 100 / coords.h;

            var img = previewImg.get(0);

            var w = arr[10], h = arr[11];

            previewImg.css({
                width: Math.round(rx * w) + 'px',
                height: Math.round(ry * h) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px'
            });
        }
    };

    window.AvatarField = AvatarField;

    var toggle = {
        upload: '[data-toggle="btn-avatar-upload"]'
    };


    $(document).on('click', toggle.upload, function (e) {
        var btn = $(e.currentTarget),
            input = $(btn.data('target')),
            outer = input.closest('.field-avatar-ow'),
            url = $kd.getUrl('ajax/platform/photo/upload/temp', {}),
            hiddenValue = $('input.avatar-value', outer),
            cropImg = $('.field-crop-img', outer),
            previewImg = $('.field-preview-img', outer),
            cropApi;

        if (!cropImg.attr('reset')) {
            cropImg.attr('reset', cropImg.attr('src'));
        }

        function updateData(coords, nx, ny, dim) {
            var opts = hiddenValue.data('opts');
            var value = [opts.type, opts.id, coords.x, coords.y, coords.x2, coords.y2, coords.w, coords.h, dim[0], dim[1], nx, ny].join(';');
            hiddenValue.val(value);
        }

        function showPreview(coords) {
            var rx = 100 / coords.w;
            var ry = 100 / coords.h;

            var img = previewImg.get(0);

            var w = img.naturalWidth;
            var h = img.naturalHeight;

            updateData(coords, w, h, cropApi.getBounds());

            previewImg.css({
                width: Math.round(rx * w) + 'px',
                height: Math.round(ry * h) + 'px',
                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                marginTop: '-' + Math.round(ry * coords.y) + 'px'
            });
        }

        function enableCrop(img) {
            img.Jcrop({
                onSelect: showPreview,
                onChange: showPreview,
                aspectRatio: 1.0,
                allowSelect: true,
                minSize: [120, 120],
                maxSize: [320, 320]
            }, function () {
                cropApi = this;
                cropApi.focus();
                var dim = cropApi.getBounds();
                var size = 220;
                var startX = Math.ceil((dim[0] - size) / 2);
                var startY = Math.ceil((dim[1] - size) / 2);

                cropApi.setSelect([
                    startX, startY, startX + size, startY + size
                ]);
            });
        }

        if (!input.data('upload')) {
            input.data('upload', new PhotosUpload(input, {
                url: url,
                fileName: 'fileUpload',
                onNewFile: function (eid, index, file, input, plugin) {
                    plugin.processQueue();
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
                    if (_debug) {
                        console.log(data);
                    }
                    var opts = {
                        type: 'temp',
                        id: data.id
                    }

                    hiddenValue.data('opts', opts);
                    cropImg.prop('src', data.url);
                    previewImg.prop('src', data.url);
                    enableCrop(cropImg);
                }
            }));
        }
        input.trigger('click');
    });
});