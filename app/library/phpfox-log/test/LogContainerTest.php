<?php

namespace Phpfox\Logger;


class LogContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $logger = new LogContainer();

        $logger->add(new DbLogger([
            'level' => 'debug',
            'model' => PHPFOX_TABLE_PREFIX . 'core_log',
        ]));

        $logger->add(new FilesLogger([
            'filename' => '.test.log',
            'level'    => 'debug',
        ]));

        $l1 = $this->totalRows();
        $logger->alert('log message {0}', [time()]);

        $l2 = $this->totalRows();
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->critical('log message {0}', [time()]);

        $l2 = $this->totalRows();
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;
        $logger->error('log message {0}', [time()]);
        $l2 = $this->totalRows();
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;
        $logger->emergency('log message {0}', [time()]);
        $l2 = $this->totalRows();
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;
        $logger->debug('log message {0}', [time()]);
        $l2 = $this->totalRows();
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;
        $logger->warning('log message {0}', [time()]);
        $l2 = $this->totalRows();
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;
        $logger->info('log message {0}', [time()]);
        $l2 = $this->totalRows();
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->notice('log message {0}', [time()]);
        $l2 = $this->totalRows();
        $this->assertTrue($l1 < $l2);
        $l1 = $l2;

        $logger->log('debug', 'log message {0}', [time()]);
        $l2 = $this->totalRows();
        $this->assertTrue($l1 < $l2);
    }

    function totalRows()
    {
        return _get('db')
            ->select('*')
            ->from(':core_log')
            ->count();
    }
}
