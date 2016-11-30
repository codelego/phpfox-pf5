define(['jquery', 'platform/core/core'], function ($, $kd) {
    var _debug = true,
        toggle = {
            upload: '[data-toggle="tl-cover-upload"]',
            cancel: '[data-toggle="tl-cover-cancel"]',
            reposition: '[data-toggle="tl-cover-reposition"]',
            remove: '[data-toggle="tl-cover-remove"]'
        };

    function startEditing() {
        $('.user-tlh-ow').addClass('edit-mode');
    }

    function endEditing() {
        $('.user-tlh-ow').removeClass('edit-mode');
    }

    function startReposition(img) {
        startEditing();
        img.draggable({
            //containment: 'parent',
            scroll: false,
            axis: "y",
            cursor: "move",
            stop: function (event, ui) {
                var maxTop = 0;
                var minTop = img.parent().height() - img.height();
                var top = ui.position.top;
                if (top > maxTop) {
                    img.animate({
                        top: maxTop
                    }, 300);
                } else
                    if (top < minTop) {
                        img.animate({
                            top: minTop
                        }, 300);
                    }
            }
        });
    }

    function stopReposition(img) {
        endEditing();
        img.draggable("destroy");
    }

    $kd.action('tl-cover-remove', function (btn) {
            var outer = btn.closest('.user-cover-ow'),
                img = $('.user-cover-img');

            endEditing();

            var send = {
                parent: btn.data('object')
            };

            $kd.ajax('ajax/platform/photo/cover/remove', send)
                .success(function () {
                    img.attr('src', '');
                    outer.removeClass('has-cover');
                })
                .error();
        })
        .action('tl-cover-reposition', function () {
            var img = $('.user-cover-img');
            requirejs(['jqueryui'], function () {
                startReposition(img)
            });
        })
        .action('tl-cover-save', function (btn) {
            var img = $('.user-cover-img'),
                send = {
                    fileId: img.data('fid'),
                    uploaded: img.data('uploaded'),
                    obj: btn.data('obj'),
                    top: img.position().top,
                    size: {
                        width: img.width(),
                        height: img.height()
                    }
                };

            _debug && console.log(send);

            $kd.ajax('ajax/platform/photo/cover/save', send)
                .success(function (response) {
                    stopReposition(img);
                    endEditing();

                    if (response.message) {
                        Toast.success(response.message);
                    }

                    if (response.url) {
                        fetchPage(response.url);
                    }
                })
                .error();
        })
        .action('tl-cover-remove', function () {
            var img = $('.user-cover-img'),
                reset = img.attr('reset');

            endEditing();

            if (!reset) return false;

            img.prop('src', reset).css({
                backgroundImage: 'none'
            });
        }).action('tl-cover-upload', function (btn) {
        var input = $(btn.data('target')),
            url = $kd.getUrl('ajax/platform/photo/upload/temp', {}),
            img = $('.user-cover-img');

        if (!img.attr('reset')) {
            img.attr('reset', img.attr('src'));
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
                    img.prop('src', data.url)
                        .data('fid', data.id)
                        .data('uploaded', '1');
                    startReposition(img);
                }
            }));
        }

        /**
         * do not put trigger to callback function, it's not work since browsers security.
         */
        requirejs(['jqueryui'], function () {});

        input.trigger('click');
    });

    // exports

    /**
     * export this function to called from server, when ?editcover=1&fileId=....
     */
    window.startDraggableTimelineCoverImgForEdit = function () {
        requirejs(['jqueryui'], function () {
            startReposition($('.user-cover-img'));
        });
    }
});