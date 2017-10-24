define([
    'core',
    'package/jquery/jquery.toast'
], function () {
    var Core = require('core'),
        Toast = require('package/jquery/jquery.toast');

    Core.cmd('admin.i18n.phrase.save', function (ele,evt) {

        var form = ele.closest('form');

        if (form.hasClass('disabled'))
            return false;

        Core.ajaxForm(form)
            .done(function (data) {
                if (data.cmd == 'delete') {
                    form.closest('tr').fadeOut(250, function () {
                        form.closest('tr').remove();
                    });
                } else {
                    form.closest('td').find('p.text-value').html(data.value);
                    form.toggleClass('hide');
                    Toast.success(data.message);
                }

            })
            .error(function () {
                alert('can not save form');
            });
        evt.preventDefault();
        return false;
    }).cmd('admin.i18n.phrase.delete', function (btn) {
        btn.closest('tr').addClass('hide');
    });
});