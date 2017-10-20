<?php

namespace Phpfox\Mailer;


class SystemAdapterTest extends \PHPUnit_Framework_TestCase
{

    public function testSendMail()
    {
        $transport = new SystemAdapter();

        $msg = new Message();
        $msg->fromArray([
            'from'    => ['nam.ngvan@gmail.com', 'nam nguyen'],
            'subject' => 'test subject',
            'body'    => 'test body',
            'altBody' => 'test alt body',
        ]);
        $msg->addTo('namnv@younetco.com', 'Nam Nguyen');
        $transport->send($msg);
    }
}
