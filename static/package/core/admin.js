define(['core'], function () {
    var Core = require('core');

    Core.cmd('admin.i18n.testEmail', function (form) {
        Core.ajaxForm(form).always(function(data){
            form.replaceWith(data);
        });
        return false;
    });
});