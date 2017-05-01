/**
 * @author Nam Nguyen <nam.ngvan@gmail.com>
 * handle th, td dropdown
 * do not use bootstrap dropdown because table & overflow: hidden issues.
 * must post item into corner
 */
define(['jquery', 'underscore'], function () {
    var DropDown = function (element) {
        var offset = element.offset(),
            id = 'id_td_dropdown',
            html = '<div id="<%= id %>" class="fly-dropdown"><div class="dropdown open"></div></div>',
            container = $(_.template(html)({id: id}));

        $('#' + id).remove();

        container.appendTo('body').css({left: offset.left, top: offset.top,position: 'absolute'});
        $('.dropdown', container).html($('ul', element).clone().removeClass('hide').addClass('dropdown-menu'));
        $('ul', container).hover(function () {
        }, function () {
            container.remove();
        });
    }
    $(document).on('click', '[data-cmd="dropdown"]', function () {
        new DropDown($(this));
    })
    return DropDown;
});