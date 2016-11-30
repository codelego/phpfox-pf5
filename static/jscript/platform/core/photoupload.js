define(['jquery', 'platform/core/core'], function ($) {
    var _debug = false,
        defaults = {
            url: '',
            method: 'POST',
            extraData: {},
            maxFileSize: 0,
            maxFiles: 0,
            allowedTypes: '*',
            extFilter: null,
            dataType: null,
            fileName: 'fileUpload',
            onInit: function () {
                // approach for init
            },
            onFallbackMode: function () {
                // fallback
            },
            onChange: function (number, plugin) {

            },
            onQueue: function (plugin) {

            },
            onNewFile: function (eid, id, file) {
                // newfile attached
            },
            onBeforeUpload: function (eid, id) {
                // before upload
            },
            onComplete: function () {
                // complete upload
            },
            onUploadProgress: function (eid, id, percent) {
                // change upload progress
            },
            onUploadSuccess: function (eid, id, data) {
                // upload success
            },
            onUploadError: function (eid, id, message) {
                // upload error
            },
            onFileTypeError: function (file) {
                // invalid file type
            },
            onFileSizeError: function (file) {
                // invalid file size
            },
            onFileExtError: function (file) {
                // file extends invalid
            },
            onFilesMaxError: function (file) {
            },
            element: function (input) {
                return input;
            }
        };

    var PhotosUpload = function (input, options) {

        if (_debug)
            console.info("init PhotoUploads with options", options);

        this.input = $(input);

        this.settings = $.extend({}, defaults, options);

        if (!this.checkBrowser()) {

        }

        this.init();
    };

    PhotosUpload.prototype.checkBrowser = function () {
        if (window.FormData === undefined) {
            this.settings.onFallbackMode.call(this.input, 'Browser doesn\'t support Form API');

            return false;
        }

        if (this.input.find('input[type=file]').length > 0) {
            return true;
        }

        if (!this.checkEvent('drop', this.input) || !this.checkEvent('dragstart', this.input)) {
            this.settings.onFallbackMode.call(this.input, 'Browser doesn\'t support Ajax Drag and Drop');

            return false;
        }

        return true;
    };

    PhotosUpload.prototype.checkEvent = function (eventName, input) {
        input = input || document.createElement('div');
        eventName = 'on' + eventName;

        var isSupported = eventName in input;

        if (!isSupported) {
            if (!input.setAttribute) {
                input = document.createElement('div');
            }
            if (input.setAttribute && input.removeAttribute) {
                input.setAttribute(eventName, '');
                isSupported = typeof input[eventName] == 'function';

                if (typeof input[eventName] != 'undefined') {
                    input[eventName] = undefined;
                }
                input.removeAttribute(eventName);
            }
        }

        input = null;
        return isSupported;
    };

    PhotosUpload.prototype.init = function () {
        var widget = this;

        widget.queue = [];
        widget.queuePos = -1;
        widget.queueRunning = false;

        // -- Drag and drop event
        widget.input.on('drop', function (evt) {
            evt.preventDefault();
            var files = evt.originalEvent.dataTransfer.files;

            widget.queueFiles(files);

            widget.settings.onChange(files.length, widget);
        });

        //-- Optional File input to make a clickable area

        this.input.on('change', function (evt) {
            var files = evt.target.files;

            widget.queueFiles(files);

            widget.settings.onChange(files.length, widget);

            //$(this).val('');
        });

        this.settings.onInit.call(this.input);
    };

    PhotosUpload.prototype.queueFiles = function (files) {

        var j = this.queue.length;

        for (var i = 0; i < files.length; i++) {

            var file = files[i];

            // Check file size
            if ((this.settings.maxFileSize > 0) &&
                (file.size > this.settings.maxFileSize)) {

                this.settings.onFileSizeError.call(this.input, file);

                continue;
            }

            // Check file type
            if ((this.settings.allowedTypes != '*') && !file.type.match(this.settings.allowedTypes)) {

                this.settings.onFileTypeError.call(this.input, file);

                continue;
            }

            // Check file extension
            if (this.settings.extFilter != null) {
                var extList = this.settings.extFilter.toLowerCase().split(';');

                var ext = file.name.toLowerCase().split('.').pop();

                if ($.inArray(ext, extList) < 0) {
                    this.settings.onFileExtError.call(this.input, file);

                    continue;
                }
            }

            // Check max files
            if (this.settings.maxFiles > 0) {
                if (this.queue.length >= this.settings.maxFiles) {
                    this.settings.onFilesMaxError.call(this.input, file);

                    continue;
                }
            }

            this.queue.push(file);

            var index = this.queue.length - 1;
            var eid = $.newId('e');
            file.eid = eid;

            this.settings.onNewFile.call(this.input, eid, index, file, this.input, this);
        }

        // Only start Queue if we haven't!
        if (this.queueRunning) {
            return false;
        }

        // and only if new Failes were successfully added
        if (this.queue.length == j) {
            return false;
        }

        this.settings.onQueue(this);

        return true;
    };

    PhotosUpload.prototype.processQueue = function () {
        var widget = this;

        widget.queuePos++;

        if (widget.queuePos >= widget.queue.length) {
            // Cleanup

            widget.settings.onComplete.call(widget.input);

            // Wait until new files are droped
            widget.queuePos = (widget.queue.length - 1);

            widget.queueRunning = false;

            return;
        }

        var file = widget.queue[widget.queuePos];

        var eid = file.eid;

        // Form Data
        var fd = new FormData();
        fd.append(widget.settings.fileName, file);

        // Return from client function (default === undefined)
        var can_continue = widget.settings.onBeforeUpload.call(widget.input, eid, widget.queuePos);

        // If the client function doesn't return FALSE then continue
        if (false === can_continue) {
            return;
        }

        // Append extra Form Data
        $.each(widget.settings.extraData, function (exKey, exVal) {
            fd.append(exKey, exVal);
        });

        widget.queueRunning = true;

        // Ajax Submit
        $.ajax({
            url: widget.settings.url,
            type: widget.settings.method,
            dataType: widget.settings.dataType,
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            forceSync: false,
            xhr: function () {
                var xhrobj = $.ajaxSettings.xhr();
                if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function (event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total || e.totalSize;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }

                        widget.settings.onUploadProgress.call(widget.input, eid, widget.queuePos, percent, this.input);
                    }, false);
                }

                return xhrobj;
            },
            success: function (data, message, xhr) {
                widget.settings.onUploadSuccess.call(widget.input, eid, widget.queuePos, data, widget.input);
            },
            error: function (xhr, status, errMsg) {
                widget.settings.onUploadError.call(widget.input, eid, widget.queuePos, errMsg, widget.input);
            },
            complete: function (xhr, textStatus) {
                widget.processQueue();
            }
        });
    }

    $(document).on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });
    $(document).on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });
    $(document).on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
    });

    window.PhotosUpload = PhotosUpload;
});