<?php

namespace Phpfox\Assets;

return [
    'psr4' => [
        'Phpfox\\Assets\\' => [
            'library/phpfox-assets/src',
            'library/phpfox-assets/test',
        ],
    ],
    'services'   => [
        'html'                        => [null, HtmlFacades::class, null],
        'breadcrumb'                  => [null, Breadcrumb::class,],
        'require_js'                  => [null, RequireJs::class,],
        'require_css'                 => [null, RequireCss::class,],
        'html.title'                  => [null, HeadTitle::class],
        'html.keyword'                => [null, HeadKeyword::class],
        'html.description'            => [null, HeadDescription::class],
        'html.meta'                   => [null, HeadMeta::class],
        'html.open_graph'             => [null, HeadOpenGraph::class],
        'html.link'                   => [null, HeadLink::class],
        'html.start.style'            => [null, ExternalStyle::class],
        'html.start.inline_style'     => [null, InlineStyle::class],
        'html.start.script'           => [null, ExternalScript::class],
        'html.start.inline_script'    => [null, InlineScript::class],
        'html.start.static_html'      => [null, StaticHtml::class],
        'html.shutdown.script'        => [null, ExternalScript::class],
        'html.shutdown.inline_script' => [null, InlineScript::class],
        'html.shutdown.static_html'   => [null, StaticHtml::class],

    ],
];