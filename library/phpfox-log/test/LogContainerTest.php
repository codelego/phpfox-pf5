<?php

namespace Phpfox\Log;


class LogContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testInfo()
    {
        $container = $this->getContainer();

        $container->info('{1} test log level INFO', [0, 'Nam Nguyen']);
        $container->debug('{1} test log level DEBUG', [0, 'Nam Nguyen']);
        $container->critical('{1} test log level CRITICAL', [0, 'Nam Nguyen']);
    }

    public function getContainer()
    {
        $container = new LogContainer();

        $container->add(new FilesystemLogger([
            'filename' => 'main.log',
            'accepts'  => 'debug',
        ]));

        $container->add(new FilesystemLogger([
            'filename' => 'system.log',
            'accepts'  => 'info',
        ]));

        $container->add(new FilesystemLogger([
            'filename' => 'translate.log',
            'accepts'  => 'critical',
        ]));

        return $container;
    }
}
