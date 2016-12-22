<?php

namespace PHPSTORM_META {

    override(\Phpfox::emit(0), map([
        'onBeforeJavascriptRender' => \Phpfox\Event\Response::class,
    ]));
}