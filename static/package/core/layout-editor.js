define([
    'jquery',
    'jqueryui',
], function () {
    // Sortable rows
    $('ul.layout-editor-location').sortable({
        placeholder: 'layout-editor-block-placeholder',
        connectWith: "ul.layout-editor-location",
        start: function (event, ui) {
            ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
            ui.item.toggleClass("highlight");
        }
    });
});