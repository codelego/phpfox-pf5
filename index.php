<?php
include __DIR__ . '/config/bootstrap.php';


Phpfox::html()
    ->addScripts('require', null)
    ->addStyle('bootstrap', null)
    ->setTitle('some think like this')
    ->setKeyword('phpfox, social network script, social network platform, neutron')
    ->setDescription('Nothing loose the content');

$content = Phpfox::get('views')->render('layout.master.default', [
    'layout_content' => 'content',
    'phpfox'         => Phpfox::getServiceContainer(),
]);


Phpfox::get('main.log')->debug($content);
