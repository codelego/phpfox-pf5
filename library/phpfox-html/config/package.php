<?php

namespace Phpfox\Html {

    return [
        'autoload.psr4'  => [
            'Phpfox\\Html\\' => [
                'library\phpfox-html\src',
                'library\phpfox-html\test',
            ],
        ],
        'html.container' => [
            'title'           => [null, HeadTitle::class],
            'headKeyword'     => [null, HeadKeyword::class],
            'headMeta'        => [null, HeadMeta::class],
            'openGraph'       => [null, HeadOpenGraph::class],
            'links'           => [null, HeadLink::class],
            'styles'          => [null, ExternalStyle::class],
            'inlineStyles'    => [null, InlineStyle::class],
            'script'          => [null, ExternalScript::class],
            'startScript'     => [null, InlineScript::class],
            'bootHtml'        => [null, StaticHtml::class],
            'shutdownScripts' => [null, InlineScript::class],
            'breadcrumb'      => [null, Breadcrumb::class,],
        ],
        'service.map'    => [
            'html' => [null, HtmlFacades::class, null],
        ],
    ];
}
