define(['jqueryui', 'package/jquery/jquery-nested-sortable', 'core'], function () {
    var Core = require('core');

    var group = $("ol.sortable").sortable({
        delay: 100,
        onDrop: function ($item, container, _super) {
            var items = group.find('li'), id, item, result = {}, url = $('.menu-editor').data('url');

            for (var i = 0; i < items.length; ++i) {
                item = $(items.get(i));
                id = '_' + item.data('id');
                result[id] = {
                    ordering: i,
                    parent: item.closest('ol').data('name')
                };
            }

            $.post(url, {ordering: result});
            _super($item, container);
        }
    });

    Core.cmd('menu.item.edit', function (btn) {
        Core.dialog.open({
            data: {item_id: btn.data('id')},
            url: Core.url('admincp/core/menu/edit-item')
        });
    }).cmd('menu.item.delete', function (btn) {
        if (btn.closest('li').find('ol li').length > 0) {
            Core.dialog.alert({message: btn.data('message2')});
        } else {
            Core.dialog.confirm({message: btn.data('message')}, function () {
                $.post(Core.url('admincp/core/menu/delete-item'), {item_id: btn.data('id')});
                if (btn.data('custom') == '1') {
                    btn.closest('li').animate({opacity: 0}, 200, function () {
                        $(this).remove()
                    });
                } else {
                    btn.closest('div').addClass('disabled');
                }
            });

        }
    });
});