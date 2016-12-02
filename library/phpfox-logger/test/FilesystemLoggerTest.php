<?php

namespace Phpfox\Logger;


class FilesystemLoggerTest extends \PHPUnit_Framework_TestCase
{

    public function testWriter()
    {
        $logger = new FilesLogger([
            'filename' => 'main.log',
        ]);

        $logger->info('{0} is working on {1}',
            ['nam.ngvan@gmail.com', 'phpfox']);
    }
}
