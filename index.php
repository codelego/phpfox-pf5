<?php
include __DIR__ . '/config/bootstrap.php';


Phpfox::html()->addScripts('require', null)->addStyle('bootstrap', null)
    ->setTitle('some think like this')
    ->setKeyword('phpfox, social network script, social network platform, neutron')
    ->setDescription('Nothing loose the content');

$content = Phpfox::getViews()->render('layout.master.default', [
        'layout_content' => 'content',
    ]);

Phpfox::get('session')->start();

echo Phpfox::trans('toi la {0}', null, null, ['nam nguyen']);