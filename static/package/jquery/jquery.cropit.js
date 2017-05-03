define(['jquery','jqueryui','kendo/extensions/jquery.rangeslider'], function () {

    var CropIt,
        _debug = true,
        _defaults = {
            minZoom: 1.0,
            maxZoom: 2.0,
            tpl1: '<img src="<%= src %>" class="cropit-img cropit-preview-img" width="<%= width %>" height="<%= height %>"/>',
            tpl2: '<img src="<%= src %>" class="cropit-img cropit-draggable-img" width="<%= width %>" height="<%= height %>"/>',
            tpl3: '<img src="<%= src %>" class="cropit-img cropit-thumbnail-img" width="<%= width %>" height="<%= height %>"/>',
        };

    CropIt = function (element) {
        this.container = $(element);
        this.settings = $.extend({}, _defaults, {});
        this.imgSrc = this.container.data('src');
        this.overlay = $('.cropit-overlay');
        this.stage = $('.cropit-overlay-stage', this.container);
        this.content = $('.cropit-content', this.container);
        this.thumbnail = $('.cropit-thumbnail', this.container);
        this.imgWidth = 0;
        this.imgHeight = 0;
        var that = this;
        this.previewImg = null;
        this.dragableImg = null;
        this.thumbnailImg = null;
        this.scale = 1;
        this.zoomInput = $('.cropit-zoom', that.container);
        this.thumbScale = this.thumbnail.width() / this.content.width();
        this.content = $('.cropit-content', this.container);
        this.cropitInputOptions = $('.cropit_options', this.container);

        /**
         * load image source to get width/height.
         */

        var img = new Image();

        img.src = that.imgSrc;

        img.onload = function () {
            that.imgWidth = this.naturalWidth;
            that.imgHeight = this.naturalHeight;
            loadSuccess();
        };

        function updateCropitValue() {
            var pos1 = that.dragableImg.position(),
                pos2 = that.content.position();

            that.cropitInputOptions.val([
                that.dragableImg.width(),
                that.dragableImg.height(),
                that.content.width(),
                that.content.height(),
                Math.ceil(pos2.left - pos1.left),
                Math.ceil(pos2.top  - pos1.top)
            ].join(','));

            _debug && console.log(that.cropitInputOptions.val());
        }

        function loadSuccess() {

            that.scale = Math.max(that.container.width() / that.imgWidth, that.container.height() / that.imgHeight);
            that.minZoom = Math.max(that.content.width() / that.imgWidth, that.content.height() / that.imgHeight);
            that.maxZoom = that.minZoom * 4;
            that.zoomInput.val(Math.ceil((that.scale - that.minZoom) / (that.maxZoom - that.minZoom) * 100));

            var width = that.imgWidth * that.scale,
                height = that.imgHeight * that.scale,
                left = (that.stage.width() - width) / 2,
                top = (that.stage.height() - height) / 2;

            $(_.template(that.settings.tpl1)({
                src: that.imgSrc,
                width: width,
                height: height
            })).css({
                left: left,
                top: top
            }).appendTo(that.content);

            $(_.template(that.settings.tpl2)({
                src: that.imgSrc,
                width: width,
                height: height
            })).css({
                left: left,
                top: top
            }).insertAfter(that.content);

            $(_.template(that.settings.tpl3)({
                src: that.imgSrc,
                width: width * that.thumbScale,
                height: height * that.thumbScale
            })).css({
                left: left * that.thumbScale,
                top: top * that.thumbScale
            }).appendTo(that.thumbnail);

            that.previewImg = $('.cropit-preview-img', that.container);
            that.dragableImg = $('.cropit-draggable-img', that.container);
            that.thumbnailImg = $('.cropit-thumbnail-img', that.container);

            that.dragableImg.draggable({
                addClass: false,
                axis: 'xy',
                drag: function (event, ui) {

                    var left = ui.position.left,
                        top = ui.position.top,
                        position = that.content.position();

                    if (left > position.left) {
                        left = position.left;
                    }

                    if (top > position.top) {
                        top = position.top;
                    }

                    that.previewImg.css({
                        left: left,
                        top: top,
                    });
                    that.thumbnailImg.css({
                        left: left * that.thumbScale,
                        top: top * that.thumbScale,
                    });
                    updateCropitValue();
                }
            });

            updateCropitValue();
        }

        function changedZoomValue(zoomVal) {
            var scale = zoomVal / 100 * (that.maxZoom - that.minZoom) + that.minZoom,
                left = that.dragableImg.position.left * scale / that.scale / 2,
                top = that.dragableImg.position.top * scale / that.scale / 2;

            // update scale
            that.scale = scale;

            //console.log(scale);

            that.dragableImg.attr({
                width: scale * that.imgWidth,
                height: scale * that.imgHeight
            }).css({
                left: left,
                top: top
            });
            that.previewImg.attr({
                width: scale * that.imgWidth,
                height: scale * that.imgHeight
            }).css({
                left: left,
                top: top
            });
            that.thumbnailImg.attr({
                width: that.scale * that.imgWidth * that.thumbScale,
                height: that.scale * that.imgHeight * that.thumbScale
            });

            updateCropitValue();
        }

        that.zoomInput.on('change', function () {
            changedZoomValue($(this).val())
        });

        that.zoomInput.rangeslider({
            polyfill: false,
            // Callback function
            onSlide: function (position, value) {
                //console.log('onSlide');
                //console.log('position: ' + position, 'value: ' + value);
                changedZoomValue(value);
            }
        });
    };

    window.CropIt = CropIt;
});