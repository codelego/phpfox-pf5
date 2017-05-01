define(['jquery'], function ($) {
    var Core = {
        options: {
            baseUrl: '/',
            staticUrl: '/',
            logged: false,
            isUser: false
        },
        /**
         * Get url by prepend current static base url.
         *
         * @param {string} url
         * @returns {string}
         */
        staticUrl: function (url) {
            return this.options.staticUrl + url;
        },
        /**
         * Set options
         * @param options
         */
        setOptions: function (options) {
            this.options = $.extend({}, this.options, options);
        },
        /**
         * get options
         * @returns {*}
         */
        getOptions: function () {
            return this.options;
        },
        /**
         * @returns {string}
         */
        getBaseUrl: function () {
            return this.options.baseUrl;
        },
        /**
         *
         * @param {string} url
         * @param {object|undefined|string} data
         * @returns {string}
         */
        getUrl: function (url, data) {

            var h = '';

            if (typeof data == 'string') {
                h = '?' + data;
            }
            else if (typeof data == 'object') {
                h = '?' + $.param(data);
            }

            return this.getBaseUrl() + url.replace(/^\/+/, '') + h;
        },
        /**
         * Open modal box
         * @param url
         * @param data
         */
        modal: function (url, data) {
            data = $.extend({isDialog: true}, data);
            return $kd.ajax(url, data)
                .done(function (response) {
                    Hyves.create(response.html).show();
                });
        },
        /**
         * Close model box
         */
        closeModal: function () {
            Hyves.destroy();
        },
        /**
         * Create ajax request
         * @param url
         * @param data
         * @returns {jQuery.ajax}
         */
        ajax: function (url, data) {
            return $.ajax({
                url: Core.getUrl(url),
                data: arguments[1],
                method: 'post',
                dataType: 'json'
            });
        },
        /**
         * Current viewer logged?
         *
         * @returns {boolean}
         */
        logged: function () {
            return this.options.logged
        },
        /**
         * Current viewer is user
         *
         * @returns {boolean}
         */
        isUser: function () {
            return this.options.isUser
        },
        authRequired: function () {
            if (!this.logged()) {
                this.modal('ajax/platform/user/auth/login-dialog', {msg: 'core.login_required'});
                return false;
            }
            return true;
        },
        actions: {},
        action: function (key, cb) {
            $kd.actions[key] = cb;
            return this;
        }
    };
    return Core;
});