define(['jquery', 'platform/core/core', 'jqueryui'], function ($, $kd) {
    var editor = '#layouteditor',
        debug = true,
        blockKey = {
            prefix: 'b',
            length: 15
        },
        sectionKey = {
            prefix: 'b',
            length: 12
        },
        checkContainerLoop = function () {
            //$('.location.leaf', '.location.leaf').remove();
        },
        enableDragDrop = function () {
            debug && console.log("enabled drag & drop");

            $(".available_containers").sortable({
                connectWith: "#layouteditor .location.node",
                handle: '.dragable-element-header',
                cancel: '.element-placeholder',
                cursor: 'move',
                opacity: 0.6,
                dropOnEmpty: true,
                remove: function (event, ui) {
                    var anchor = ui.item.data('anchor');
                    ui.item.clone().insertAfter(anchor);
                    var sendData = collectBlockData(ui.item, 0);
                    $kd.ajax('admincp/platform/layout/ajax/editor/add-block', sendData)
                        .done(function (data) {
                            ui.item.data('cid', data.block_id);
                        });
                }
            });

            $(".available_blocks").sortable({
                connectWith: "#layouteditor .location",
                handle: '.dragable-element-header',
                cancel: '.element-placeholder',
                cursor: 'move',
                opacity: 0.6,
                dropOnEmpty: true,
                remove: function (event, ui) {
                    var anchor = ui.item.data('anchor');
                    ui.item.clone().insertAfter(anchor);
                    var sendData = collectBlockData(ui.item, 0);
                    $kd.ajax('admincp/platform/layout/ajax/editor/add-block', sendData)
                        .done(function (data) {
                            ui.item.data('cid', data.block_id);
                        });
                }
            });

            $("#layouteditor .location").sortable({
                connectWith: "#layouteditor .location",
                cursor: 'move',
                //handle: '.dragable-element', // cancel this mode because it's failed .
                //cancel: '.dragable-element-placeholder'
                dropOnEmpty: true,
                remove: function () {
                    checkContainerLoop();
                    saveLayout();
                }
            }).disableSelection();

            $('#layouteditor').sortable({
                connectWith: $('#layouteditor'),
                handle: '.section-header',
                cancel: '.section-placeholder',
                cursor: 'move',
                dropOnEmpty: true
                //dropOnEmpty: false
            }).disableSelection();
        },
        getLayoutConfigData = function () {
            return $(editor).data('object');
        };


    $.fn.layoutEditorEnabledDragDrop = function () {
        enableDragDrop();
    }

    function layoutAddSection(ele) {
        var sendData = $.extend({}, {tpl: ele.data('tpl')});

        $kd.ajax('admincp/platform/layout/ajax/editor/add-section', sendData)
            .done(function (response) {
                $(response.html).prependTo('#layouteditor');
                enableDragDrop();
            });
    }

    function layoutChangeSection(ele) {

        var main = $('.section-main', '#layouteditor'),
            obj = $('#layouteditor').data('object'),
            sendData = $.extend({sectionType: 'main'}, obj, {tpl: ele.data('tpl')});


        $kd.ajax('admincp/platform/layout/ajax/editor/change-section', sendData)
            .done(function (response) {
                if (main.length) {
                    main.replaceWith(response.html);
                }
                else {
                    $('#layouteditor').append(response.html);
                }
                enableDragDrop();
            });
    }


    function collectLeafBlockData(block, order) {
        var locations = $('>.dragable-element-body >.row > .location.leaf', block);
        return {
            block_id: block.data('cid'),
            block_order: order,
            parent_block_id: block.closest('.location.node').data('cid') || '',
            support_block_id: block.data('support'),
            section: block.closest('.section').data('cid'),
            node_id: block.closest('.location.node').data('cid') || '',
            leaf_id: block.closest('.location.leaf').data('cid')|| '',
            settings: block.data('settings'),
            blocks: collectLeafBlockListData(locations)
        }
    }

    /**
     *
     * @param locations
     */
    function collectLeafBlockListData(locations) {
        var blocks,
            block,
            blockDatas = {},
            key,
            n = 0,
            i = 0;

        for (; n < locations.length; ++n) {
            blocks = $('>.dragable-element', locations[n]);
            for (i = 0; i < blocks.length; ++i) {
                block = $(blocks[i]);
                key = block.data('cid');
                blockDatas[key] = collectLeafBlockData(block, i);
            }
        }
        return blockDatas;
    }

    /**
     *
     * @param block
     */
    function collectBlockData(block, order) {
        var locations = $('>.dragable-element-body >.row > .location.leaf', block);

        return {
            block_id: block.data('cid'),
            support_block_id: block.data('support'),
            parent_block_id: '0',
            section_id: block.closest('.section').data('cid'),
            node_id: block.closest('.location.node').data('cid') || '',
            leaf_id: block.closest('.location.leaf').data('cid') || '',
            block_order: order,
            render: block.data('render') || '',
            settings: block.data('settings') || '',
            blocks: collectLeafBlockListData(locations)
        };
    }

    /**
     *
     * @param locations
     */
    function collectBlockListData(locations) {
        var blocks,
            block,
            blockDatas = {},
            key,
            n = 0,
            i = 0;

        for (; n < locations.length; ++n) {
            blocks = $('>.dragable-element', locations[n]);
            for (i = 0; i < blocks.length; ++i) {
                block = $(blocks[i]);
                key = block.data('cid');
                blockDatas[key] = collectBlockData(block, i);
            }
        }
        return blockDatas;
    }

    /**
     *
     */
    function collectRemainBlockIdList(section) {
        var blocks = $('.dragable-element', section), i = 0,
            blockIdList = [];

        for (; i < blocks.length; ++i) {
            blockIdList.push($(blocks[i]).data('cid'));
        }

        return blockIdList;
    }

    /**
     *
     */
    function collectSectionData(section, order) {
        var locations = $('.location.node', section);

        return {
            section_id: section.data('cid'),
            section_order: order,
            section_template: section.data('render'),
            blocks: collectBlockListData(locations),
            remainBlockIdList: collectRemainBlockIdList(section)
        };
    }

    /**
     * find of handersee.
     *
     * @returns {{}}
     */
    function collectLayoutData() {
        checkContainerLoop();
        var sections = $('.section', editor),
            i = 0,
            sectionsData = {},
            sectionId,
            section,
            sendData = $(editor).data('object');

        for (; i < sections.length; ++i) {
            section = $(sections[i]);
            sectionId = section.data('cid');
            sectionsData[sectionId] = collectSectionData(section, i);
        }

        sendData.sections = sectionsData;

        return sendData;
    }

    function saveLayout() {
        // check missing data id at first.
        var sendData = collectLayoutData();

        console.log(sendData);

        // collect all block with-out block_id then call back themes all.

        $kd.ajax('admincp/platform/layout/ajax/editor/update-layout', sendData)
            .done(function (response) {
                console.log(response);
            });
    }

    $kd.action('layout-edit-content', function (ele) {
        var url = 'admincp/platform/layout/ajax/editor/edit-content-setting',
            sendData = $.extend({layoutType: ele.data('layout')}, getLayoutConfigData());
        $kd.modal(url, sendData);
    }).action('layout-delete-content', function (ele) {
        var url = 'admincp/platform/layout/ajax/editor/delete-content-setting',
            sendData = $.extend({layoutType: ele.data('layout')}, getLayoutConfigData());
        $kd.ajax(url, sendData)
            .done(function (result) {
                Toast.success(result.message);
            });
    }).action('layout-change-section', function (ele) {
        layoutChangeSection(ele);
    }).action('layout-add-section', function (ele) {
        layoutAddSection(ele);
    }).action('layout-block-edit', function (ele) {
        var url = 'admincp/platform/layout/ajax/editor/select-block-script',
            sendData = $.extend({}, getLayoutConfigData(), ele.data('object'));

        sendData.blockId = $(sendData.eid).closest('.dragable-element').data('cid');

        $kd.modal(url, sendData);

    }).action('layout-block-settings', function (ele) {
        var url = 'admincp/platform/layout/ajax/editor/edit-block-settings',
            sendData = $.extend({}, getLayoutConfigData(), ele.data('object'));

        sendData.blockId = $(sendData.eid).closest('.dragable-element').data('cid');

        $kd.modal(url, sendData);

    }).action('layout-decorator-edit', function (ele) {
        var url = 'admincp/platform/layout/ajax/editor/edit-block-decorator',
            sendData = $.extend({}, getLayoutConfigData(), ele.data('object'));

        sendData.blockId = $(sendData.eid).closest('.dragable-element').data('cid');

        $kd.modal(url, sendData);

    }).action('layout-block-remove', function (ele) {
        var data = ele.data('object'),
            block = $(data.eid).closest('.dragable-element');
        $kd.ajax('admincp/platform/layout/ajax/editor/remove-block', {'block_id': block.data('cid')})
            .done(function () {
                block.remove()
            });
    }).action('layout-save', function () {
        saveLayout();
    }).action('layout-block-update', function (ele) {
        var form = ele.closest('form'),
            sendData = form.serializeJSON(),
            block = $(sendData.eid).closest('.dragable-element');

        $kd.ajax('admincp/platform/layout/ajax/editor/update-block-settings', sendData)
            .done(function (response) {
                if (response.code == 200) {
                    block.data('settings', sendData);
                }
                if (response.script) {
                    eval(response.script);
                }
                if (response.html) {

                }
                block.data('settings', sendData);
            });
    }).action('layout-section-edit', function (ele) {

    }).action('layout-section-remove', function (ele) {
        var eid = ele.data('eid'),
            section = $(eid).closest('.section'),
            sectionId = section.data('cid');

        section.animate({opacity: 0}, 200, function () {
            section.remove()
        });

        $kd.ajax('admincp/platform/layout/ajax/editor/delete-section', {sectionId: sectionId})
            .done(function (result) {
                Toast.success(result.message);
            });
    }).action('platform-layout-blocks-toggle', function (ele) {
        ele.parent().toggleClass('open');
    });
});