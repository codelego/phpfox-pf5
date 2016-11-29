<?php

namespace Phpfox\Log;


class FilesystemLoggerTest extends \PHPUnit_Framework_TestCase
{

    public function testWriter()
    {
        $logger = new FilesystemLogger([
            'filename' => 'main.log',
        ]);

        $logger->info('{0} is working on {1}',
            ['namnv@younetco.com', 'phpfox']);
    }
}
