define(['jquery', 'platform/core/core'], function ($, $kd) {
    var _SpotLight,
        _debug = false,
        _toggle = '[data-toggle="spotlight"]';

    _SpotLight = function () {
        var data = {
                id: 0,
                parentType: 'album',
                parentId: 0
            },
            dialog = false,
            dialogOverlay,
            dialogStageOut,
            dialogStageIn,
            dialogContent,
            isShowing = false,
            contentSize = {
                width: 0,
                height: 0
            },
            spotlightUrl,
            rightWidth = 360,
            marginOverlay = 20;

        /**
         * create dialog
         */
        function createDialog() {
            if (dialog) return;

            dialog = $('<div class="spotlight-dialog"/>', {
                'class': 'spotlight-dialog'
            }).appendTo('body');

            dialogOverlay = $('<div class="spotlight-overlay"/>').appendTo(dialog);
            dialogStageOut = $('<div class="spotlight-stageout" />').appendTo(dialog);
            dialogStageIn = $('<div class="spotlight-stagein" />').appendTo(dialogStageOut);
            dialogContent = $('<div class="spotlight-content" />').appendTo(dialogStageIn);

            dialogOverlay.on('click', function () {
                closeDialog();
            })
        }

        /**
         *
         */
        function showDialog() {
            dialog.removeClass('hidden');
            isShowing = true;
        }

        function hideDialog() {

        }

        function closeDialog() {
            if (!dialog) return;
            dialog.addClass('hidden');
            dialogContent.html('');
            isShowing = false;
        }

        /**
         * success callback from sendRequest
         * @param data
         */
        function onRequestSuccess(data) {
            var content = $(data.html);
            updateContentSize(data.image, content);
            dialogContent.css({
                width: contentSize.width,
                height: contentSize.height
            });
            dialogContent.html(content);
        }

        function updateContentSize(image, content) {
            var win = $(window),
                winSize = {
                    width: win.width(),
                    height: win.height()
                },
                imageSize = {
                    width: image.width,
                    height: image.height
                },
                stageSize = {
                    width: winSize.width - marginOverlay * 2 - rightWidth,
                    height: winSize.height - marginOverlay * 2
                },
                ratio = Math.min(stageSize.width / imageSize.width, stageSize.height / imageSize.height);

            /**
             * Retype contentSize
             * @type {{width: number, height: number}}
             */
            contentSize = {
                width: winSize.width - marginOverlay * 2,
                height: winSize.height - marginOverlay * 2
            };

            if(_debug)
                console.log('ratio', ratio);


            imageSize.width = Math.floor(ratio * imageSize.width);
            imageSize.height = Math.floor(ratio * imageSize.height);

            if(_debug)
                console.log('imageSize', imageSize);

            //leftSize.width = imageSize.width;

            //contentSize.width = imageSize.width + rightWidth;
            if(_debug)
                console.log('contentSize', contentSize);
            /**
             * correct size of photo stage
             */
            content.find('.spotlight-left').css({
                width: contentSize.width - rightWidth + 'px',
                lineHeight: contentSize.height + 'px'
            });
            /**
             * centerlize content
             */
            content.find('.spotlight-stage-ow').css({});

            content.find('.spotlight-photo').css({
                width: imageSize.width - 2,
                height: imageSize.height - 2
            });
            content.css({width: contentSize.width});
        }

        function onRequestComplete() {

        }

        function onRequestError() {

        }

        function sendRequest(url) {
            spotlightUrl = url;
            $.getJSON(url, {mode: 'spotlight'})
                .done(onRequestSuccess)
                .complete(onRequestComplete)
                .error(onRequestError);
        }

        function openSpotLight(url) {
            createDialog();
            showDialog();
            sendRequest(url);
        }

        this.hideDialog = function () {
            hideDialog();
        }

        this.closeDialog = function () {
            closeDialog();
        }

        $(document).on('page_change_start', function () {
            closeDialog();
        }).on('click', '[data-toggle="spotlight-hide"]', function () {
            hideDialog();
        }).on('click', '[data-toggle="spotlight-close"]', function () {
            closeDialog();
        }).on('click', _toggle, function (evt) {
            var ele = $(evt.currentTarget),
                url = ele.prop('href');
            evt.preventDefault();

            if (window.screen.width < 700) {
                fetchPage(url);
            } else {
                openSpotLight(url);
            }

        });
    };

    window.SpotLight = new _SpotLight();
});