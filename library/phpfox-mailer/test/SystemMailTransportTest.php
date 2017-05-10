<?php

namespace Phpfox\Mailer;


class SystemMailTransportTest extends \PHPUnit_Framework_TestCase
{

    public function testSendMail()
    {
        $transport = new SystemMailAdapter();

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
