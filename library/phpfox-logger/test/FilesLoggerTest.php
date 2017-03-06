<?php
namespace Phpfox\Logger;


class FilesLoggerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $logger = new FilesLogger([
            'filename' => '.test.log',
            'level'    => 'debug',
        ]);
        $filename = PHPFOX_LOG_DIR . '.test.log';

        if (!file_exists($filename)) {
            $fp = fopen($filename, 'w');
            fwrite($fp, 'generate for testing');
            fclose($fp);
        }

        $l1 = strlen(file_get_contents($filename));

        $logger->alert('log message {0}', [time()]);

        $l2 = strlen(file_get_contents($filename));
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->critical('log message {0}', [time()]);

        $l2 = strlen(file_get_contents($filename));
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->error('log message {0}', [time()]);

        $l2 = strlen(file_get_contents($filename));
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->emergency('log message {0}', [time()]);

        $l2 = strlen(file_get_contents($filename));
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->debug('log message {0}', [time()]);

        $l2 = strlen(file_get_contents($filename));
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->warning('log message {0}', [time()]);

        $l2 = strlen(file_get_contents($filename));
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->notice('log message {0}', [time()]);
        $l2 = strlen(file_get_contents($filename));
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->info('log message {0}', [time()]);

        $l2 = strlen(file_get_contents($filename));
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->log('debug', 'log message {0}', [time()]);

        $l2 = strlen(file_get_contents($filename));
        $this->assertTrue($l1 < $l2);

        @unlink($filename);
    }
}
