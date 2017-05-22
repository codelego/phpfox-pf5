define([
    'jquery',
    'jqueryui',
], function () {
    // Sortable rows
    $("tbody").sortable({
        update: function (event, ui) {
            var table = ui.item.closest('table'),
                url = table.data('sorturl'),
                ordering = $.map(table.find('input.ordering'), function (item) {
                    return item.value;
                });
            $.post(url, {ordering: ordering}, function (data) {
                console.log(data);
            });
        }
    });
});