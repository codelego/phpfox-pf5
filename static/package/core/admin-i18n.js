define([
    'main',
    'jscript/jquery/jquery.toast'
], function (main, Toast) {
    main.cmd('admin.i18n.phrase.save', function (ele) {

        var form = ele.closest('form');

        if (form.hasClass('disabled'))
            return false;

        $.ajaxForm(form.closest('form'))
            .done(function (data) {
                if (data.cmd == 'delete') {
                    form.closest('tr').fadeOut(250, function () {
                        form.closest('tr').remove();
                    });
                } else {
                    form.closest('tr').find('p.text-value').text(data.item.value);
                    form.toggleClass('hide');
                    Toast.success(data.message);
                }

            })
            .error(function () {
                alert('can not save form');
            });
    }).cmd('admin.i18n.phrase.delete', function (btn) {
        btn.closest('tr').addClass('hide');
    });
});